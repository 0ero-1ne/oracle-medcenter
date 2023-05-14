<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "BRANCH_DEPARTMENT".
 *
 * @property int $ID
 * @property int $BRANCH_ID
 * @property int $DEPARTMENT_ID
 *
 * @property DEPARTMENTS $dEPARTMENT
 */
class BranchDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'BRANCH_DEPARTMENT';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'BRANCH_ID', 'DEPARTMENT_ID'], 'integer'],
            [['BRANCH_ID', 'DEPARTMENT_ID'], 'required'],
            [['ID'], 'unique'],
            [['DEPARTMENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DEPARTMENTS::class, 'targetAttribute' => ['DEPARTMENT_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'BRANCH_ID' => 'Branch ID',
            'DEPARTMENT_ID' => 'Department ID',
        ];
    }

    /**
     * Gets query for [[DEPARTMENT]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDEPARTMENT()
    {
        return $this->hasOne(DEPARTMENTS::class, ['ID' => 'DEPARTMENT_ID']);
    }
}
