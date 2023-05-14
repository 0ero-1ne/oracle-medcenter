<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "DEPARTMENT_EMPLOYEE".
 *
 * @property int $ID
 * @property int $DEPARTMENT_ID
 * @property int $EMPLOYEE_ID
 *
 * @property EMPLOYEES $eMPLOYEE
 */
class DepartmentEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DEPARTMENT_EMPLOYEE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'DEPARTMENT_ID', 'EMPLOYEE_ID'], 'integer'],
            [['DEPARTMENT_ID', 'EMPLOYEE_ID'], 'required'],
            [['ID'], 'unique'],
            [['EMPLOYEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EMPLOYEES::class, 'targetAttribute' => ['EMPLOYEE_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DEPARTMENT_ID' => 'Department ID',
            'EMPLOYEE_ID' => 'Employee ID',
        ];
    }

    /**
     * Gets query for [[EMPLOYEE]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEMPLOYEE()
    {
        return $this->hasOne(EMPLOYEES::class, ['ID' => 'EMPLOYEE_ID']);
    }
}
