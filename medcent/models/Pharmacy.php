<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PHARMACY".
 *
 * @property int $ID
 * @property string $DRUG
 * @property float $PRICE
 * @property int $STOCK
 * @property string $NEED_RECIPE
 * @property int $SUPPLIER_ID
 *
 * @property SUPPLIERS $sUPPLIER
 */
class Pharmacy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PHARMACY';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'STOCK', 'SUPPLIER_ID'], 'integer'],
            [['PRICE', 'STOCK', 'SUPPLIER_ID', 'ID', 'DRUG', 'NEED_RECIPE'], 'required'],
            [['PRICE'], 'number'],
            [['DRUG'], 'string', 'max' => 256],
            [['NEED_RECIPE'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SUPPLIERS::class, 'targetAttribute' => ['SUPPLIER_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DRUG' => 'Drug',
            'PRICE' => 'Price',
            'STOCK' => 'Stock',
            'NEED_RECIPE' => 'Need Recipe',
            'SUPPLIER_ID' => 'Supplier ID',
        ];
    }

    /**
     * Gets query for [[SUPPLIER]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(SUPPLIERS::class, ['ID' => 'SUPPLIER_ID']);
    }
}
