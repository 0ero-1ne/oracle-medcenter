<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "DEPARTMENTS".
 *
 * @property int $ID
 * @property string $DEPARTMENT_NAME
 * @property int $ADDRESS_ID
 * @property int|null $DEPARTMENT_MANAGER
 *
 * @property EMPLOYEES $dEPARTMENTMANAGER
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DEPARTMENTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'ADDRESS_ID', 'DEPARTMENT_MANAGER'], 'integer'],
            [['ADDRESS_ID', 'DEPARTMENT_NAME'], 'required'],
            [['DEPARTMENT_NAME'], 'string', 'max' => 256],
            [['ID'], 'unique'],
            [['DEPARTMENT_MANAGER'], 'exist', 'skipOnError' => true, 'targetClass' => EMPLOYEES::class, 'targetAttribute' => ['DEPARTMENT_MANAGER' => 'ID']],
            [['ADDRESS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ADDRESSES::class, 'targetAttribute' => ['ADDRESS_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DEPARTMENT_NAME' => 'Department Name',
            'ADDRESS_ID' => 'Address ID',
            'DEPARTMENT_MANAGER' => 'Department Manager',
        ];
    }

    /**
     * Gets query for [[DEPARTMENTMANAGER]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDEPARTMENTMANAGER()
    {
        return $this->hasOne(EMPLOYEES::class, ['ID' => 'DEPARTMENT_MANAGER']);
    }
}
