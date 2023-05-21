<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Employees;
use app\models\EmployeesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeesController implements the CRUD actions for Employees model.
 */
class EmployeesController extends Controller
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
     * Lists all Employees models.
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

        $searchModel = new EmployeesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employees model.
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
     * Creates a new Employees model.
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

        $last_id = Employees::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0;
        $model = new Employees();
        $model->ID = $last_id + 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $auth = $model->AUTH_DATA;
                $person = $model->PERSON_ID;
                $position = $model->POSITION_ID;
                $hire_date = $model->HIRE_DATE;
                $education = $model->EDUCATION;
                $phone = $model->PHONE;
                $salary = $model->SALARY;
                $vacation = $model->ON_VACATION;

                $command = Yii::$app->db->createCommand('
                    BEGIN system.employees_tapi.create_employee(:auth, :person, :position, :hire, :education, :phone, :salary, :vacation); END;
                ')
                ->bindParam(':auth', $auth)
                ->bindParam(':person', $person)
                ->bindParam(':position', $position)
                ->bindParam(':hire', $hire_date)
                ->bindParam(':education', $education)
                ->bindParam(':phone', $phone)
                ->bindParam(':salary', $salary)
                ->bindParam(':vacation', $vacation)
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
     * Updates an existing Employees model.
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
            $auth = $model->AUTH_DATA;
            $person = $model->PERSON_ID;
            $position = $model->POSITION_ID;
            $hire_date = $model->HIRE_DATE;
            $education = $model->EDUCATION;
            $phone = $model->PHONE;
            $salary = $model->SALARY;
            $vacation = $model->ON_VACATION;

            $command = Yii::$app->db->createCommand('
                BEGIN system.employees_tapi.update_employee(:id, :auth, :person, :position, :hire, :education, :phone, :salary, :vacation); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':auth', $auth)
            ->bindParam(':person', $person)
            ->bindParam(':position', $position)
            ->bindParam(':hire', $hire_date)
            ->bindParam(':education', $education)
            ->bindParam(':phone', $phone)
            ->bindParam(':salary', $salary)
            ->bindParam(':vacation', $vacation)
            ->execute();

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employees model.
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
            BEGIN system.employees_tapi.delete_employee(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employees model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Employees the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Employees::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
