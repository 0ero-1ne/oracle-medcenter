<?php

namespace app\models;

use Yii;

class BookTalon extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'TALONS';
    }
    
    public function rules()
    {
        return [
            [['PATIENT_ID'], 'required'],
            [['PATIENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PATIENTS::class, 'targetAttribute' => ['PATIENT_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PATIENT_ID' => 'Пациент',
        ];
    }
}
