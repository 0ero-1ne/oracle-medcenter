<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PERSON_ADDRESS".
 *
 * @property int $ID
 * @property int $PERSON_ID
 * @property int $ADDRESS_ID
 *
 * @property PERSONS $pERSON
 */
class PersonAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PERSON_ADDRESS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'PERSON_ID', 'ADDRESS_ID'], 'integer'],
            [['PERSON_ID', 'ADDRESS_ID'], 'required'],
            [['ID'], 'unique'],
            [['PERSON_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PERSONS::class, 'targetAttribute' => ['PERSON_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PERSON_ID' => 'Person ID',
            'ADDRESS_ID' => 'Address ID',
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
}
