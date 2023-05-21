<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\DepartmentEmployee;
use app\models\DepartmentEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentEmployeeController implements the CRUD actions for DepartmentEmployee model.
 */
class DepartmentEmployeeController extends Controller
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
     * Lists all DepartmentEmployee models.
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

        $searchModel = new DepartmentEmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DepartmentEmployee model.
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
     * Creates a new DepartmentEmployee model.
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

        $model = new DepartmentEmployee();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $department = $model->DEPARTMENT_ID;
                $employee = $model->EMPLOYEE_ID;

                $depEmp = DepartmentEmployee::findOne(['DEPARTMENT_ID' => $model->DEPARTMENT_ID, 'EMPLOYEE_ID' => $model->EMPLOYEE_ID]);
                
                if ($depEmp) {
                    Yii::$app->getSession()->setFlash('error','Already exists');
                    return $this->render('create', [
                        'model' => $model
                    ]);
                }

                $command = Yii::$app->db->createCommand('
                    BEGIN system.department_employee_tapi.create_department_employee(:dep, :emp); END;
                ')
                ->bindParam(':dep', $department)
                ->bindParam(':emp', $employee)
                ->execute();

                return $this->redirect('/admin/department-employee');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DepartmentEmployee model.
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
            $department = $model->DEPARTMENT_ID;
            $employee = $model->EMPLOYEE_ID;
            $depEmp = DepartmentEmployee::findOne(['DEPARTMENT_ID' => $model->DEPARTMENT_ID, 'EMPLOYEE_ID' => $model->EMPLOYEE_ID]);
                
            if ($depEmp) {
                Yii::$app->getSession()->setFlash('error','Already exists');
                return $this->render('update', [
                    'model' => $model
                ]);
            }

            $command = Yii::$app->db->createCommand('
                BEGIN system.department_employee_tapi.update_department_employee(:id, :dep, :emp); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':dep', $department)
            ->bindParam(':emp', $employee)
            ->execute();
            
            return $this->redirect('/admin/department-employee');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DepartmentEmployee model.
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
                BEGIN system.department_employee_tapi.delete_department_employee(:id); END;
            ')
            ->bindParam(':id', $ID)
            ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DepartmentEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return DepartmentEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = DepartmentEmployee::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
