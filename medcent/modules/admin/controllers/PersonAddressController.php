<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\PersonAddress;
use app\models\PersonAddressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonAddressController implements the CRUD actions for PersonAddress model.
 */
class PersonAddressController extends Controller
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
     * Lists all PersonAddress models.
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

        $searchModel = new PersonAddressSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonAddress model.
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
     * Creates a new PersonAddress model.
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

        $model = new PersonAddress();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $person = $model->PERSON_ID;
                $address = $model->ADDRESS_ID;

                $perAdr = PersonAddress::findOne(['PERSON_ID' => $model->PERSON_ID, 'ADDRESS_ID' => $model->ADDRESS_ID]);
                
                if ($perAdr) {
                    Yii::$app->getSession()->setFlash('error','Already exists');
                    return $this->render('create', [
                        'model' => $model
                    ]);
                }

                $command = Yii::$app->db->createCommand('
                    BEGIN system.person_address_tapi.create_person_address(:person, :address); END;
                ')
                ->bindParam(':person', $person)
                ->bindParam(':address', $address)
                ->execute();

                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PersonAddress model.
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            $person = $model->PERSON_ID;
            $address = $model->ADDRESS_ID;
            
            $perAdr = PersonAddress::findOne(['PERSON_ID' => $model->PERSON_ID, 'ADDRESS_ID' => $model->ADDRESS_ID]);
                
            if ($perAdr) {
                Yii::$app->getSession()->setFlash('error','Already exists');
                return $this->render('update', [
                    'model' => $model
                ]);
            }

            $command = Yii::$app->db->createCommand('
                BEGIN system.person_address_tapi.update_person_address(:id, :person, :address); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':person', $person)
            ->bindParam(':address', $address)
            ->execute();

            return $this->redirect(['view', 'ID' => $ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PersonAddress model.
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
            BEGIN system.person_address_tapi.delete_person_address(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PersonAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return PersonAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = PersonAddress::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
