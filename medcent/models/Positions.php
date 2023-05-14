<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "POSITIONS".
 *
 * @property int $ID
 * @property string|null $POSITION_NAME
 * @property string|null $POSITION_TYPE
 *
 * @property EMPLOYEES[] $eMPLOYEESs
 * @property PRICELIST[] $pRICELISTs
 */
class Positions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'POSITIONS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            ['POSITION_NAME', 'unique'],
            [['ID', 'POSITION_NAME', 'POSITION_TYPE'], 'required'],
            [['POSITION_NAME'], 'string', 'max' => 256],
            [['POSITION_TYPE'], 'string', 'max' => 20],
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
            'POSITION_NAME' => 'Position Name',
            'POSITION_TYPE' => 'Position Type',
        ];
    }

    /**
     * Gets query for [[EMPLOYEESs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEMPLOYEESs()
    {
        return $this->hasMany(EMPLOYEES::class, ['POSITION_ID' => 'ID']);
    }

    /**
     * Gets query for [[PRICELISTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPRICELISTs()
    {
        return $this->hasMany(PRICELIST::class, ['POSITION_ID' => 'ID']);
    }
}
