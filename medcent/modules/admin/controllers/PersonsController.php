<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Persons;
use app\models\PersonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonsController implements the CRUD actions for Persons model.
 */
class PersonsController extends Controller
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
     * Lists all Persons models.
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

        $searchModel = new PersonsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persons model.
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
     * Creates a new Persons model.
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

        $model = new Persons();


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $first_name = $model->FIRST_NAME;
                $second_name = $model->SECOND_NAME;
                $last_name = $model->LAST_NAME;
                $birth_date = $model->BIRTH_DATE;
                $gender = $model->GENDER;

                $command = Yii::$app->db->createCommand('
                    BEGIN system.persons_tapi.create_person(:first_name, :second_name, :last_name, null, :birth_date, :gender); END;
                ')
                ->bindParam(':first_name', $first_name)
                ->bindParam(':second_name', $second_name)
                ->bindParam(':last_name', $last_name)
                ->bindParam(':birth_date', $birth_date)
                ->bindParam(':gender', $gender)
                ->execute();
                
                return $this->redirect('/admin/persons');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Persons model.
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
        $model->BIRTH_DATE = substr($model->BIRTH_DATE, 0,  10);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $first_name = $model->FIRST_NAME;
            $second_name = $model->SECOND_NAME;
            $last_name = $model->LAST_NAME;
            $birth_date = $model->BIRTH_DATE;
            $gender = $model->GENDER;

            $command = Yii::$app->db->createCommand('
                BEGIN system.persons_tapi.update_person(:id, :first_name, :second_name, :last_name, null, :birth_date, :gender); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':first_name', $first_name)
            ->bindParam(':second_name', $second_name)
            ->bindParam(':last_name', $last_name)
            ->bindParam(':birth_date', $birth_date)
            ->bindParam(':gender', $gender)
            ->execute();


            return $this->redirect('/admin/persons');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Persons model.
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
            BEGIN system.persons_tapi.delete_person(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Persons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Persons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Persons::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
