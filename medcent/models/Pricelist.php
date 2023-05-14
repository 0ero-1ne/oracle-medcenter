<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PRICELIST".
 *
 * @property int $ID
 * @property int $POSITION_ID
 * @property string $SERVICE
 * @property float $PRICE
 *
 * @property POSITIONS $pOSITION
 */
class Pricelist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PRICELIST';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'POSITION_ID'], 'integer'],
            [['POSITION_ID', 'PRICE'], 'required'],
            [['PRICE'], 'number'],
            [['SERVICE'], 'string', 'max' => 256],
            [['ID'], 'unique'],
            [['POSITION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => POSITIONS::class, 'targetAttribute' => ['POSITION_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'POSITION_ID' => 'Position ID',
            'SERVICE' => 'Service',
            'PRICE' => 'Price',
        ];
    }

    /**
     * Gets query for [[POSITION]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPOSITION()
    {
        return $this->hasOne(POSITIONS::class, ['ID' => 'POSITION_ID']);
    }
}
