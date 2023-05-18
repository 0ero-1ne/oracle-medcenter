<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\Talons;
use app\models\Comments;
use app\models\Pharmacy;
use app\models\BookTalon;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goBack();
        }

        $model->email = '';
        $model->password = '';
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionTalons()
    {
        $talons = (new Query)
            ->select([
                'PERSONS.FIRST_NAME',
                'PERSONS.SECOND_NAME',
                'PERSONS.LAST_NAME',
                'POSITIONS.POSITION_NAME',
                'EMPLOYEES.ID',
                'TALONS.ID',
                'TALONS.TALON_DATE',
                'ADDRESSES.REGION',
                'ADDRESSES.TOWN',
                'ADDRESSES.STREET',
                'ADDRESSES.HOUSE_NUMBER'])
            ->from('PERSONS')
            ->innerJoin('EMPLOYEES', 'EMPLOYEES.PERSON_ID = PERSONS.ID')
            ->innerJoin('POSITIONS', 'POSITIONS.ID = EMPLOYEES.POSITION_ID')
            ->innerJoin('DEPARTMENT_EMPLOYEE', 'DEPARTMENT_EMPLOYEE.EMPLOYEE_ID = EMPLOYEES.ID')
            ->innerJoin('DEPARTMENTS', 'DEPARTMENTS.ID = DEPARTMENT_EMPLOYEE.DEPARTMENT_ID')
            ->innerJoin('ADDRESSES', 'ADDRESSES.ID = DEPARTMENTS.ADDRESS_ID')
            ->innerJoin('TALONS', 'TALONS.EMPLOYEE_ID = EMPLOYEES.ID')
            ->where('TALONS.PATIENT_ID IS NULL')
            ->andWhere("TALONS.TALON_DATE < TRUNC(ADD_MONTHS(SYSDATE, 1), 'MM')")
            ->andWhere("EMPLOYEES.ON_VACATION = '0'")
            ->orderBy([
                'POSITIONS.POSITION_NAME' => SORT_ASC,
                'TALONS.TALON_DATE' => SORT_ASC
            ])
            ->all();

        return $this->render('talons', [
            'talons' => $talons
        ]);
    }

    public function actionBookTalon($id)
    {
        $model = Talons::findOne($id);
        $bookTalon = new BookTalon();
        $userID = Yii::$app->user->identity->ID;

        $patients = (new Query)
            ->select(['PERSONS.FIRST_NAME', 'PERSONS.SECOND_NAME', 'PERSONS.LAST_NAME', 'PATIENTS.ID'])
            ->from('PERSONS')
            ->innerJoin('PATIENTS', 'PATIENTS.PERSON_ID = PERSONS.ID')
            ->where('PATIENTS.AUTH_DATA = :auth_data')
            ->addParams([':auth_data' => $userID])
            ->all();

        if ($bookTalon->load(Yii::$app->request->post())) {
            $model->PATIENT_ID = $bookTalon->PATIENT_ID;

            if ($model->save())
            {
                Yii::$app->getSession()->setFlash('success', 'Талон забронирован');
                return $this->redirect('/user');
            }
        }

        return $this->render('book-talon', [
            'bookTalon' => $bookTalon,
            'patients' => $patients
        ]);
    }

    public function actionLeaveComment()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('login');
        }

        $model = new Comments();
        $model->ID = (Comments::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0) + 1;
        $model->USER_ID = Yii::$app->user->identity->ID;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Ваш отзыв очень полезен для нас');
                return $this->goHome();
            }
        }

        return $this->render('leave-comment', [
            'model' =>$model
        ]);
    }

    public function actionPharmacy()
    {
        $pharmacy = (new Query)
            ->select(['PHARMACY.DRUG', 'PHARMACY.PRICE', 'PHARMACY.NEED_RECIPE', 'SUPPLIERS.SUPPLIER_NAME'])
            ->from('PHARMACY')
            ->innerJoin('SUPPLIERS', 'SUPPLIERS.ID = PHARMACY.SUPPLIER_ID')
            ->where('PHARMACY.STOCK > 0')
            ->all();

        return $this->render('pharmacy', [
            'pharmacy' => $pharmacy
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
