<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PASSPORTS".
 *
 * @property int $ID
 * @property string $PASSPORT_NUMBER
 * @property string $DATE_OF_ISSUE
 * @property string $DATE_OF_EXPIRY
 * @property string $AUTHORITY
 *
 * @property PERSONS[] $pERSONSs
 */
class Passports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PASSPORTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['PASSPORT_NUMBER'], 'string', 'max' => 64],
            [['DATE_OF_ISSUE', 'DATE_OF_EXPIRY'], 'date', 'format' => 'dd-M-Y'],
            [['AUTHORITY'], 'string', 'max' => 256],
            [['ID'], 'unique'],
            [['PASSPORT_NUMBER'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PASSPORT_NUMBER' => 'Passport Number',
            'DATE_OF_ISSUE' => 'Date Of Issue',
            'DATE_OF_EXPIRY' => 'Date Of Expiry',
            'AUTHORITY' => 'Authority',
        ];
    }

    /**
     * Gets query for [[PERSONSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONSs()
    {
        return $this->hasMany(PERSONS::class, ['PASSPORT_ID' => 'ID']);
    }
}
