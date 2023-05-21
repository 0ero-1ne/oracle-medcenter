<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Treatments;
use app\models\TreatmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TreatmentsController implements the CRUD actions for Treatments model.
 */
class TreatmentsController extends Controller
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
     * Lists all Treatments models.
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

        $searchModel = new TreatmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Treatments model.
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
     * Creates a new Treatments model.
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

        $model = new Treatments();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $employee = $model->EMPLOYEE_ID;
                $patient = $model->PATIENT_ID;
                $start = $model->START_OF_TREATMENT;
                $end = $model->END_OF_TREATMENT;
                $diagnosis = $model->DIAGNOSIS;
                $info = $model->TREATMENT_INFO;
                $recs = $model->RECOMMENDATIONS;

                $command = Yii::$app->db->createCommand('
                    BEGIN system.treatments_tapi.create_treatment(:emp, :pat, :start, :end, :diag, :info, :recs); END;
                ')
                ->bindParam(':emp', $employee)
                ->bindParam(':pat', $patient)
                ->bindParam(':start', $start)
                ->bindParam(':end', $end)
                ->bindParam(':diag', $diagnosis)
                ->bindParam(':info', $info)
                ->bindParam(':recs', $recs)
                ->execute();

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Treatments model.
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
            $employee = $model->EMPLOYEE_ID;
            $patient = $model->PATIENT_ID;
            $start = $model->START_OF_TREATMENT;
            $end = $model->END_OF_TREATMENT;
            $diagnosis = $model->DIAGNOSIS;
            $info = $model->TREATMENT_INFO;
            $recs = $model->RECOMMENDATIONS;

            $command = Yii::$app->db->createCommand('
                BEGIN system.treatments_tapi.update_treatment(:id, :emp, :pat, :start, :end, :diag, :info, :recs); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':emp', $employee)
            ->bindParam(':pat', $patient)
            ->bindParam(':start', $start)
            ->bindParam(':end', $end)
            ->bindParam(':diag', $diagnosis)
            ->bindParam(':info', $info)
            ->bindParam(':recs', $recs)
            ->execute();

            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Treatments model.
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
            BEGIN system.treatments_tapi.delete_treatment(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Treatments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Treatments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Treatments::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
