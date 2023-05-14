<?php

namespace app\modules\admin\controllers;

use app\models\Roles;
use app\models\RolesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RolesController extends Controller
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
     * Lists all Roles models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RolesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Roles model.
     * @param string $ROLE_NAME Role Name
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ROLE_NAME)
    {
        return $this->render('view', [
            'model' => $this->findModel($ROLE_NAME),
        ]);
    }

    /**
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Roles();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ROLE_NAME' => $model->ROLE_NAME]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ROLE_NAME Role Name
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ROLE_NAME)
    {
        $model = $this->findModel($ROLE_NAME);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ROLE_NAME' => $model->ROLE_NAME]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ROLE_NAME Role Name
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ROLE_NAME)
    {
        $this->findModel($ROLE_NAME)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ROLE_NAME Role Name
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ROLE_NAME)
    {
        if (($model = Roles::findOne(['ROLE_NAME' => $ROLE_NAME])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
