<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ADDRESSES".
 *
 * @property int $ID
 * @property string $REGION
 * @property string $TOWN
 * @property string $STREET
 * @property string $HOUSE_NUMBER
 * @property string|null $FLAT
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ADDRESSES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'REGION', 'TOWN', 'STREET', 'HOUSE_NUMBER'], 'required'],
            [['ID'], 'integer'],
            [['REGION', 'TOWN', 'STREET'], 'string', 'max' => 64],
            [['HOUSE_NUMBER', 'FLAT'], 'string', 'max' => 10],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'REGION' => 'Область',
            'TOWN' => 'Населённый пункт',
            'STREET' => 'Улица',
            'HOUSE_NUMBER' => 'Номер дома',
            'FLAT' => 'Квартира (если есть)',
        ];
    }
}
