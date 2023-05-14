<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SUPPLIERS".
 *
 * @property int $ID
 * @property string $SUPPLIER_NAME
 * @property string $SUPPLIER_COUNTRY
 *
 * @property PHARMACY[] $pHARMACies
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SUPPLIERS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['ID', 'SUPPLIER__NAME','SUPPLIER_COUNTRY'],'required'],
            [['SUPPLIER_NAME'], 'string', 'max' => 256],
            [['SUPPLIER_COUNTRY'], 'string', 'max' => 64],
            [['ID','SUPPLIER_NAME'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SUPPLIER_NAME' => 'Supplier Name',
            'SUPPLIER_COUNTRY' => 'Supplier Country',
        ];
    }

    /**
     * Gets query for [[PHARMACies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPHARMACies()
    {
        return $this->hasMany(PHARMACY::class, ['SUPPLIER_ID' => 'ID']);
    }
}
