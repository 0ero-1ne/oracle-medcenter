<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TALONS".
 *
 * @property int $ID
 * @property string $TALON_DATE
 * @property int $EMPLOYEE_ID
 * @property int|null $PATIENT_ID
 *
 * @property PATIENTS $pATIENT
 */
class Talons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TALONS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'EMPLOYEE_ID', 'PATIENT_ID'], 'integer'],
            [['EMPLOYEE_ID','TALON_DATE'], 'required'],
            [['TALON_DATE'], 'datetime', 'format' => 'php:d.m.Y H:i'],
            [['ID'], 'unique'],
            [['PATIENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PATIENTS::class, 'targetAttribute' => ['PATIENT_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'TALON_DATE' => 'Дата',
            'EMPLOYEE_ID' => 'Сотрудник',
            'PATIENT_ID' => 'Пациент',
        ];
    }

    /**
     * Gets query for [[PATIENT]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPATIENT()
    {
        return $this->hasOne(PATIENTS::class, ['ID' => 'PATIENT_ID']);
    }
}
