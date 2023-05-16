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
            //[['HIRE_DATE'], 'date', 'format' => 'd.m.Y H:i:s'],
            [['EDUCATION'], 'string', 'max' => 256],
            [['PHONE'], 'match', 'pattern' => '/^(80)([ ]{1})(\(29\)|\(44\)|\(25\)|\(33\))([ ]{1})([0-9]{3})([-]{1})([0-9]{2})([-]{1})([0-9]{2})$/','message' => 'Phone pattern: 80 (25/29/33/44) xxx-xx-xx'],
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
