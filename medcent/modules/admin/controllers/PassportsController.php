<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Passports;
use app\models\PassportsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PassportsController implements the CRUD actions for Passports model.
 */
class PassportsController extends Controller
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
     * Lists all Passports models.
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

        $searchModel = new PassportsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Passports model.
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
     * Creates a new Passports model.
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

        $model = new Passports();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $number = $model->PASSPORT_NUMBER;
                $issue_date = $model->DATE_OF_ISSUE;
                $expiry_date = $model->DATE_OF_EXPIRY;
                $authority = $model->AUTHORITY;

                $command = Yii::$app->db->createCommand('
                    BEGIN system.passports_tapi.create_passport(:number, :issue, :expiry, :authority); END;
                ')
                ->bindParam(':number', $number)
                ->bindParam(':issue', $issue_date)
                ->bindParam(':expiry', $expiry_date)
                ->bindParam(':authority', $authority)
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
     * Updates an existing Passports model.
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
        $model->DATE_OF_ISSUE = substr($model->DATE_OF_ISSUE, 0, 10);
        $model->DATE_OF_EXPIRY = substr($model->DATE_OF_EXPIRY, 0, 10);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $number = $model->PASSPORT_NUMBER;
            $issue_date = $model->DATE_OF_ISSUE;
            $expiry_date = $model->DATE_OF_EXPIRY;
            $authority = $model->AUTHORITY;

            $command = Yii::$app->db->createCommand('
                BEGIN system.passports_tapi.update_passport(:id, :number, :issue, :expiry, :authority); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':number', $number)
            ->bindParam(':issue', $issue_date)
            ->bindParam(':expiry', $expiry_date)
            ->bindParam(':authority', $authority)
            ->execute();

            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Passports model.
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
            BEGIN system.passports_tapi.delete_passport(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Passports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Passports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Passports::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
