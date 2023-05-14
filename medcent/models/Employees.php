<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "EMPLOYEES".
 *
 * @property int $ID
 * @property int $AUTH_DATA
 * @property int $PERSON_ID
 * @property int $POSITION_ID
 * @property string $HIRE_DATE
 * @property string $EDUCATION
 * @property string $PHONE
 * @property float $SALARY
 * @property string $ON_VACATION
 *
 * @property BRANCHES[] $bRANCHESs
 * @property DEPARTMENTS[] $dEPARTMENTSs
 * @property POSITIONS $pOSITION
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EMPLOYEES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'AUTH_DATA', 'PERSON_ID', 'POSITION_ID'], 'integer'],
            [['AUTH_DATA', 'PERSON_ID', 'POSITION_ID', 'SALARY','PHONE','EDUCATION','HIRE_DATE','ON_VACATION','ID'], 'required'],
            [['SALARY'], 'number'],
            [['HIRE_DATE'], 'date', 'format' => 'dd-M-Y'],
            [['EDUCATION'], 'string', 'max' => 256],
            [['PHONE'], 'string', 'max' => 20],
            [['ON_VACATION'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['AUTH_DATA'], 'unique'],
            [['PERSON_ID'], 'unique'],
            [['POSITION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => POSITIONS::class, 'targetAttribute' => ['POSITION_ID' => 'ID']],
            [['PERSON_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PERSONS::class, 'targetAttribute' => ['PERSON_ID' => 'ID']],
            [['AUTH_DATA'], 'exist', 'skipOnError' => true, 'targetClass' => USERS::class, 'targetAttribute' => ['AUTH_DATA' => 'ID']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'AUTH_DATA' => 'Auth Data',
            'PERSON_ID' => 'Person ID',
            'POSITION_ID' => 'Position ID',
            'HIRE_DATE' => 'Hire Date',
            'EDUCATION' => 'Education',
            'PHONE' => 'Phone',
            'SALARY' => 'Salary',
            'ON_VACATION' => 'On Vacation',
        ];
    }

    /**
     * Gets query for [[BRANCHESs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBRANCHESs()
    {
        return $this->hasMany(BRANCHES::class, ['BRANCH_MANAGER' => 'ID']);
    }

    /**
     * Gets query for [[DEPARTMENTEMPLOYEEs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDEPARTMENTEMPLOYEEs()
    {
        return $this->hasMany(DEPARTMENTEMPLOYEE::class, ['EMPLOYEE_ID' => 'ID']);
    }

    /**
     * Gets query for [[POSITION]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPOSITION()
    {
        return $this->hasOne(POSITIONS::class, ['ID' => 'POSITION_ID']);
    }
}
