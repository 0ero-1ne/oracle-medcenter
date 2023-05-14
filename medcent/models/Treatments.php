<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TREATMENTS".
 *
 * @property int $ID
 * @property int $EMPLOYEE_ID
 * @property int $PATIENT_ID
 * @property string $START_OF_TREATMENT
 * @property string|null $END_OF_TREATMENT
 * @property string $DIAGNOSIS
 * @property string $TREATMENT_INFO
 * @property string $RECOMMENDATIONS
 *
 * @property PATIENTS $pATIENT
 */
class Treatments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TREATMENTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'EMPLOYEE_ID', 'PATIENT_ID'], 'integer'],
            [['EMPLOYEE_ID', 'PATIENT_ID'], 'required'],
            [['START_OF_TREATMENT', 'END_OF_TREATMENT'], 'string', 'max' => 7],
            [['DIAGNOSIS'], 'string', 'max' => 256],
            [['TREATMENT_INFO', 'RECOMMENDATIONS'], 'string', 'max' => 1024],
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
            'EMPLOYEE_ID' => 'Employee ID',
            'PATIENT_ID' => 'Patient ID',
            'START_OF_TREATMENT' => 'Start Of Treatment',
            'END_OF_TREATMENT' => 'End Of Treatment',
            'DIAGNOSIS' => 'Diagnosis',
            'TREATMENT_INFO' => 'Treatment Info',
            'RECOMMENDATIONS' => 'Recommendations',
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
