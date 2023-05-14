<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PERSONS".
 *
 * @property int $ID
 * @property string $FIRST_NAME
 * @property string $SECOND_NAME
 * @property string|null $LAST_NAME
 * @property int|null $PASSPORT_ID
 * @property string $BIRTH_DATE
 * @property string $GENDER
 *
 * @property EMPLOYEES[] $eMPLOYEESs
 * @property PASSPORTS $pASSPORT
 * @property PATIENTS[] $pATIENTSs
 * @property PERSONADDRESS[] $pERSONADDRESSes
 */
class Persons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PERSONS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'FIRST_NAME', 'SECOND_NAME', 'LAST_NAME', 'BIRTH_DATE', 'GENDER'], 'required'],
            [['ID', 'PASSPORT_ID'], 'integer'],
            ['PASSPORT_ID','unique'],
            [['FIRST_NAME', 'SECOND_NAME', 'LAST_NAME'], 'string', 'max' => 64],
            [['BIRTH_DATE'], 'date', 'format' => 'dd-M-Y'],
            [['GENDER'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PASSPORT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PASSPORTS::class, 'targetAttribute' => ['PASSPORT_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'FIRST_NAME' => 'First Name',
            'SECOND_NAME' => 'Second Name',
            'LAST_NAME' => 'Last Name',
            'PASSPORT_ID' => 'Passport ID',
            'BIRTH_DATE' => 'Birth Date (DD-MON-YYYY)',
            'GENDER' => 'Gender',
        ];
    }

    /**
     * Gets query for [[EMPLOYEESs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEMPLOYEESs()
    {
        return $this->hasMany(EMPLOYEES::class, ['PERSON_ID' => 'ID']);
    }

    /**
     * Gets query for [[PASSPORT]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPASSPORT()
    {
        return $this->hasOne(PASSPORTS::class, ['ID' => 'PASSPORT_ID']);
    }

    /**
     * Gets query for [[PATIENTSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPATIENTSs()
    {
        return $this->hasMany(PATIENTS::class, ['PERSON_ID' => 'ID']);
    }

    /**
     * Gets query for [[PERSONADDRESSes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONADDRESSes()
    {
        return $this->hasMany(PERSONADDRESS::class, ['PERSON_ID' => 'ID']);
    }
}
