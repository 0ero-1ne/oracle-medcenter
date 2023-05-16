<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PATIENTS".
 *
 * @property int $ID
 * @property int $AUTH_DATA
 * @property int $PERSON_ID
 * @property string $PHONE
 *
 * @property PERSONS $pERSON
 * @property TALONS[] $tALONSs
 * @property TREATMENTS[] $tREATMENTSs
 */
class Patients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PATIENTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'AUTH_DATA', 'PERSON_ID'], 'integer'],
            [['AUTH_DATA', 'PERSON_ID', 'PHONE'], 'required'],
            [['PHONE'], 'match', 'pattern' => '/^(80)([ ]{1})(\(29\)|\(44\)|\(25\)|\(33\))([ ]{1})([0-9]{3})([-]{1})([0-9]{2})([-]{1})([0-9]{2})$/','message' => 'Phone pattern: 80 (25/29/33/44) xxx-xx-xx'],
            [['ID'], 'unique'],
            [['PHONE'], 'unique', 'message' => 'Please, type another phone'],
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
            'PHONE' => 'Phone',
        ];
    }

    /**
     * Gets query for [[PERSON]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPERSON()
    {
        return $this->hasOne(PERSONS::class, ['ID' => 'PERSON_ID']);
    }

    /**
     * Gets query for [[TALONSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTALONSs()
    {
        return $this->hasMany(TALONS::class, ['PATIENT_ID' => 'ID']);
    }

    /**
     * Gets query for [[TREATMENTSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTREATMENTSs()
    {
        return $this->hasMany(TREATMENTS::class, ['PATIENT_ID' => 'ID']);
    }
}
