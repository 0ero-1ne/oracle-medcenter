<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ROLES".
 *
 * @property string $ROLE_NAME
 *
 * @property USERS[] $uSERSs
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ROLES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ROLE_NAME'], 'string', 'max' => 64],
            [['ROLE_NAME'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ROLE_NAME' => 'Role Name',
        ];
    }

    /**
     * Gets query for [[USERSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUSERSs()
    {
        return $this->hasMany(USERS::class, ['USER_ROLE' => 'ROLE_NAME']);
    }
}
