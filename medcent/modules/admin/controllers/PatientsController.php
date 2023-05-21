<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Patients;
use app\models\PatientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientsController implements the CRUD actions for Patients model.
 */
class PatientsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Patients models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        $searchModel = new PatientsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patients model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Patients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        $last_id = Patients::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0;
        $model = new Patients();
        $model->ID = $last_id + 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $user = $model->AUTH_DATA;
                $person = $model->PERSON_ID;
                $phone = $model->PHONE;

                $patient = Patients::find()->where(['AUTH_DATA' => $model->AUTH_DATA])->andWhere(['PERSON_ID' => $model->PERSON_ID])->one();
                
                if ($patient) {
                    Yii::$app->getSession()->setFlash('error', 'Такой пациент уже существует');
                    return $this->render('create', [
                        'model' => $model
                    ]);
                }

                $command = Yii::$app->db->createCommand('
                    BEGIN system.patients_tapi.create_patient(:auth_data, :person, :phone); END;
                ')
                ->bindParam(':auth_data', $user)
                ->bindParam(':person', $person)
                ->bindParam(':phone', $phone)
                ->execute();

                return $this->redirect('/admin/patients');

            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Patients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        $model = $this->findModel($ID);
        $oldAuth = $model->AUTH_DATA;
        $oldPerson = $model->PERSON_ID;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $user = $model->AUTH_DATA;
            $person = $model->PERSON_ID;
            $phone = $model->PHONE;

            $command = Yii::$app->db->createCommand('
                BEGIN system.patients_tapi.update_patient(:id, :auth_data, :person, :phone); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':auth_data', $user)
            ->bindParam(':person', $person)
            ->bindParam(':phone', $phone);

            if (($oldAuth == $model->AUTH_DATA) && ($oldPerson == $model->PERSON_ID)) {
                $command->execute();
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
            
            if ($oldAuth != $model->AUTH_DATA || $oldPerson != $model->PERSON_ID) {
                $patient = Patients::find()->where(['AUTH_DATA' => $model->AUTH_DATA])->andWhere(['PERSON_ID' => $model->PERSON_ID])->one();
                if ($patient) {
                    Yii::$app->getSession()->setFlash('error', 'Such pacient is already exists');
                    return $this->render('update', [
                        'model' => $model
                    ]);
                }
            }

            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Patients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }
        
        $command = Yii::$app->db->createCommand('
            BEGIN system.patients_tapi.delete_patient(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Patients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Patients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Patients::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
