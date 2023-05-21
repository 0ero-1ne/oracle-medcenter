<?php

namespace app\modules\user\controllers;

use Yii;
use app\models\Talons;
use app\models\Addresses;
use app\models\PersonAddress;
use app\models\Persons;
use app\models\Patients;
use app\models\Users;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Query ;

function arrayIds($array)
{
    $result = [];

    foreach ($array as $value) {
        array_push($result, (integer)$value);
    }

    return $result;
}

function formatArrayOfPersonAddress($array)
{
    $result = [];

    foreach ($array as $arr) {
        array_push($result, (integer)$arr['ADDRESS_ID']);
    }

    return $result;
}

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
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
                        'actions' => ['logout', 'index', ''],
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $currentUser = Yii::$app->user->identity->ID;

        $talons = Yii::$app->db->createCommand(
            'SELECT PERSONS.FIRST_NAME,
                            PERSONS.SECOND_NAME,
                            PERSONS.LAST_NAME,
                            PATIENTS.ID,
                            TALONS.ID,
                            TALONS.TALON_DATE,
                            TALONS.EMPLOYEE_ID
            FROM PERSONS
            JOIN PATIENTS ON PATIENTS.PERSON_ID = PERSONS.ID
            JOIN TALONS ON TALONS.PATIENT_ID = PATIENTS.ID
            WHERE PATIENTS.AUTH_DATA = :param'
        )
        ->bindParam(':param', $currentUser)
        ->queryAll();

        $empIds = [];
        foreach ($talons as $talon) {
            if (!in_array($talon['EMPLOYEE_ID'], $empIds)) {
                $empIds[] = $talon['EMPLOYEE_ID'];
            }
        }
        $empIds = arrayIds($empIds);

        $employees = (new Query)
            ->select(['PERSONS.FIRST_NAME', 'PERSONS.SECOND_NAME', 'PERSONS.LAST_NAME', 'POSITIONS.POSITION_NAME', 'EMPLOYEES.ID'])
            ->from('PERSONS')
            ->innerJoin('EMPLOYEES', 'EMPLOYEES.PERSON_ID = PERSONS.ID')
            ->innerJoin('POSITIONS', 'POSITIONS.ID = EMPLOYEES.POSITION_ID')
            ->where(['IN', 'EMPLOYEES.ID', $empIds])
            ->all();

        return $this->render('index',[
            'talons' => $talons,
            'employees' => $employees
        ]);
    }

    public function actionPatients()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $currentUser = Yii::$app->user->identity->ID;

        $patients = Yii::$app->db->createCommand(
            'SELECT PERSONS.FIRST_NAME,
                            PERSONS.SECOND_NAME,
                            PERSONS.LAST_NAME,
                            PERSONS.BIRTH_DATE,
                            PATIENTS.ID
            FROM PERSONS
            JOIN PATIENTS ON PATIENTS.PERSON_ID = PERSONS.ID
            WHERE PATIENTS.AUTH_DATA = :param'
        )
        ->bindParam(':param', $currentUser)
        ->queryAll();

        return $this->render('patients', [
            'patients' => $patients
        ]);
    }

    public function actionPatient($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $patient = Patients::findOne(['ID' => $id]);
        $patientId = $patient->ID;
        $person = Persons::findOne(['ID' => $patient->PERSON_ID]);
        $personId = $person->ID;

        $personAddress = PersonAddress::find()->select('ADDRESS_ID')->where(['PERSON_ID' => $personId])->asArray()->all();
        $persAddrIds = formatArrayOfPersonAddress($personAddress);

        $addresses = (count($persAddrIds) === 0) ? [] :
            Addresses::find()->where(['ID' => $persAddrIds])->asArray()->all();
        

        return $this->render('patient', [
            'patient' => $patient,
            'person' => $person,
            'addresses' => $addresses,
            'pa' => $personAddress
        ]);
    }

    public function actionUpdatePerson($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $modelPerson = Persons::findOne($id);
        $modelPerson->PASSPORT_ID = '';
        $modelPerson->BIRTH_DATE = substr($modelPerson->BIRTH_DATE, 0, 10);

        $modelPatient = Patients::findOne(['PERSON_ID' => $id, 'AUTH_DATA' => Users::findOne(['EMAIL' => Yii::$app->user->identity->EMAIL])->ID]);

        if ($this->request->isPost) {
            if ($modelPerson->load($this->request->post()) && $modelPatient->load($this->request->post())) {
                if ($modelPerson->save() && $modelPatient->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Пациент обновлён');
                    return $this->redirect(['patient', 'id' => Patients::findOne(['PERSON_ID' => $id, 'AUTH_DATA' => Users::findOne(['EMAIL' => Yii::$app->user->identity->EMAIL])->ID])->ID]);
                }
            }
        }

        return $this->render('update-person', [
            'modelPerson' => $modelPerson,
            'modelPatient' => $modelPatient
        ]);
    }

    public function actionAddAddress($id)
    {   
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $last_id = Addresses::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0;
        $model = new Addresses();
        $model->ID = $last_id + 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $hasAddress = Addresses::findOne([
                    'REGION' => $model->REGION,
                    'TOWN' => $model->TOWN,
                    'STREET' => $model->STREET,
                    'HOUSE_NUMBER' => $model->HOUSE_NUMBER,
                    'FLAT' => $model->FLAT
                ]);

                if ($hasAddress) {
                    $hasPersonAddress = PersonAddress::findOne([
                        'PERSON_ID' => $id,
                        'ADDRESS_ID' => $hasAddress->ID
                    ]);

                    if ($hasPersonAddress) {
                        Yii::$app->getSession()->setFlash('error', 'Адрес уже привязан к пациенту');
                        return $this->redirect(['add-address', 'id' => $id]);
                    } else {
                        $newPersAddr = new PersonAddress();
                        $newPersAddr->ID = ($last_id = PersonAddress::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0) + 1;
                        $newPersAddr->PERSON_ID = $id;
                        $newPersAddr->ADDRESS_ID = $hasAddress->ID;

                        if ($newPersAddr->save()) {
                            Yii::$app->getSession()->setFlash('warning', 'Адрес успешно добавлен');
                            return $this->redirect(['patient', 'id' => Patients::findOne(['PERSON_ID' => $id])->ID]);
                        }
                    }
                } else {
                    if ($model->save()) {
                        $newPersAddr = new PersonAddress();
                        $newPersAddr->ID = ($last_id = PersonAddress::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0) + 1;
                        $newPersAddr->PERSON_ID = $id;
                        $newPersAddr->ADDRESS_ID = $model->ID;

                        if ($newPersAddr->save()) {
                            Yii::$app->getSession()->setFlash('success', 'Адрес добавлен');
                            return $this->redirect(['patient','id' => Patients::findOne(['PERSON_ID' => $id])->ID]);
                        }
                    }
                }
            }
        }

        return $this->render('add-address', [
            'model' => $model
        ]);
    }

    public function actionDeleteAddress($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = PersonAddress::findOne(['ADDRESS_ID' => $ID]);
        $model->delete();

        return $this->redirect('/user');
    }

    public function actionDeleteTalon($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $command = Yii::$app->db->createCommand('
            BEGIN system.unbook_talon(:talon_id); END;
        ')
        ->bindParam(':talon_id', $ID)
        ->execute();

        Yii::$app->getSession()->setFlash('success', 'Бронь удалена!');
        return $this->redirect('/user');
    }

    public function actionAddPatient()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $modelPerson = new Persons();
        $modelPerson->ID = (Persons::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0) + 1;
        $modelPerson->PASSPORT_ID = '';

        $modelPatient = new Patients();
        $modelPatient->ID = (Patients::find()->orderBy(['ID' => SORT_DESC])->one()->ID ?? 0) + 1;
        $modelPatient->AUTH_DATA = Users::findOne(['EMAIL' => Yii::$app->user->identity->EMAIL])->ID;
        $modelPatient->PERSON_ID = $modelPerson->ID;

        if ($this->request->isPost) {
            if ($modelPerson->load($this->request->post()) && $modelPatient->load($this->request->post())) {
                if ($modelPerson->save() && $modelPatient->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Пациент добавлен');
                    return $this->redirect(['/user/patients']);
                }
            }
        }

        return $this->render('add-patient', [
            'modelPerson' => $modelPerson,
            'modelPatient' => $modelPatient
        ]);
    }
}
