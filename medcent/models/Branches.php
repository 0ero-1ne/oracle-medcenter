<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "BRANCHES".
 *
 * @property int $ID
 * @property int $ADDRESS_ID
 * @property int $BRANCH_MANAGER
 *
 * @property EMPLOYEES $bRANCHMANAGER
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'BRANCHES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'ADDRESS_ID', 'BRANCH_MANAGER'], 'integer'],
            [['ADDRESS_ID', 'ID'], 'required'],
            [['ID'], 'unique'],
            [['BRANCH_MANAGER'], 'exist', 'skipOnError' => true, 'targetClass' => EMPLOYEES::class, 'targetAttribute' => ['BRANCH_MANAGER' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ADDRESS_ID' => 'Address ID',
            'BRANCH_MANAGER' => 'Branch Manager',
        ];
    }

    /**
     * Gets query for [[BRANCHMANAGER]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBRANCHMANAGER()
    {
        return $this->hasOne(EMPLOYEES::class, ['ID' => 'BRANCH_MANAGER']);
    }
}
