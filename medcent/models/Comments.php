<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "COMMENTS".
 *
 * @property int $ID
 * @property int $USER_ID
 * @property int $EMPLOYEE_ID
 * @property string $COMMENT_TEXT
 *
 * @property USERS $uSER
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'COMMENTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'USER_ID', 'EMPLOYEE_ID'], 'integer'],
            [['USER_ID', 'EMPLOYEE_ID', 'COMMENT_TEXT'], 'required'],
            [['COMMENT_TEXT'], 'string', 'max' => 1024],
            [['ID'], 'unique'],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => USERS::class, 'targetAttribute' => ['USER_ID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => 'User ID',
            'EMPLOYEE_ID' => 'Employee ID',
            'COMMENT_TEXT' => 'Comment Text',
        ];
    }

    /**
     * Gets query for [[USER]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(USERS::class, ['ID' => 'USER_ID']);
    }
}
