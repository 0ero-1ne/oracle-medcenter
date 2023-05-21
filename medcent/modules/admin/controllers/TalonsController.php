<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Talons;
use app\models\TalonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TalonsController implements the CRUD actions for Talons model.
 */
class TalonsController extends Controller
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
     * Lists all Talons models.
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

        $searchModel = new TalonsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Talons model.
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
     * Creates a new Talons model.
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

        $model = new Talons();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $emp = $model->EMPLOYEE_ID;
                $date = $model->TALON_DATE;
                $isTalonExists = Talons::findOne(['EMPLOYEE_ID' => $model->EMPLOYEE_ID, 'TALON_DATE' => $model->TALON_DATE]);
                
                if (strtotime($date) < strtotime('now')) {
                    YII::$app->getSession()->setFlash('error', 'Неправильно указана дата талона!');
                    return $this->render('create', [
                        'model' => $model
                    ]);
                }

                if ($isTalonExists) {
                    Yii::$app->getSession()->setFlash('error', 'Talon already exists!');
                    return $this->render('create', [
                        'model' => $model
                    ]);
                }
                
                $command = Yii::$app->db->createCommand('
                    BEGIN system.talons_tapi.create_talon(:date, :emp); END;
                ')
                ->bindParam(':date', $date)
                ->bindParam(':emp', $emp)
                ->execute();

                return $this->redirect('/admin/talons');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Talons model.
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
            $emp = $model->EMPLOYEE_ID;
            $date = $model->TALON_DATE;
            $patient = $model->PATIENT_ID;
            $isTalonExists = Talons::findOne(['EMPLOYEE_ID' => $model->EMPLOYEE_ID, 'TALON_DATE' => $model->TALON_DATE]);
            
            if (strtotime($date) < strtotime('now')) {
                YII::$app->getSession()->setFlash('error', 'Неправильно указана дата талона!');
                return $this->render('create', [
                    'model' => $model
                ]);
            }
            
            if ($isTalonExists) {
                Yii::$app->getSession()->setFlash('error', 'Talon already exists!');
                return $this->render('create', [
                    'model' => $model
                ]);
            }

            $command = Yii::$app->db->createCommand('
                BEGIN system.talons_tapi.update_talon(:id, :date, :emp, :pat); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':date', $date)
            ->bindParam(':emp', $emp)
            ->bindParam(':pat', $patient)
            ->execute();
            
            return $this->redirect('/admin/talons');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Talons model.
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
        
        $this->findModel($ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Talons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Talons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Talons::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
