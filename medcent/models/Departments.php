<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "DEPARTMENTS".
 *
 * @property int $ID
 * @property string $DEPARTMENT_NAME
 * @property int $DEPARTMENT_MANAGER
 *
 * @property BRANCHDEPARTMENT[] $bRANCHDEPARTMENTs
 * @property EMPLOYEES $dEPARTMENTMANAGER
 * @property POSITIONS[] $pOSITIONSs
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
            [['ID', 'DEPARTMENT_MANAGER'], 'integer'],
            [['DEPARTMENT_NAME','ID'], 'required'],
            [['DEPARTMENT_NAME'], 'string', 'max' => 256],
            [['ID'], 'unique'],
            [['DEPARTMENT_MANAGER'], 'exist', 'skipOnError' => true, 'targetClass' => EMPLOYEES::class, 'targetAttribute' => ['DEPARTMENT_MANAGER' => 'ID']],
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
            'DEPARTMENT_MANAGER' => 'Department Manager',
        ];
    }

    /**
     * Gets query for [[BRANCHDEPARTMENTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBRANCHDEPARTMENTs()
    {
        return $this->hasMany(BRANCHDEPARTMENT::class, ['DEPARTMENT_ID' => 'ID']);
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

    /**
     * Gets query for [[POSITIONSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPOSITIONSs()
    {
        return $this->hasMany(POSITIONS::class, ['DEPARTMENT_ID' => 'ID']);
    }
}
