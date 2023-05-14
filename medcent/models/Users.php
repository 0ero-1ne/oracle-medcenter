<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "USERS".
 *
 * @property int $ID
 * @property string $USER_ROLE
 * @property string $EMAIL
 * @property string $PASSWORD
 *
 * @property COMMENTS[] $cOMMENTSs
 * @property ROLES $uSERROLE
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'USERS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'USER_ROLE', 'EMAIL', 'PASSWORD'], 'required'],
            [['ID'], 'integer'],
            [['USER_ROLE'], 'string', 'max' => 64],
            [['EMAIL'], 'string', 'max' => 256],
            ['EMAIL', 'email'],
            [['PASSWORD'], 'string', 'max' => 128],
            [['ID'], 'unique'],
            [['EMAIL'], 'unique'],
            [['USER_ROLE'], 'exist', 'skipOnError' => true, 'targetClass' => ROLES::class, 'targetAttribute' => ['USER_ROLE' => 'ROLE_NAME']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ROLE' => 'User Role',
            'EMAIL' => 'Email',
            'PASSWORD' => 'Password',
        ];
    }

    /**
     * Gets query for [[COMMENTSs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCOMMENTSs()
    {
        return $this->hasMany(COMMENTS::class, ['USER_ID' => 'ID']);
    }

    /**
     * Gets query for [[USERROLE]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUSERROLE()
    {
        return $this->hasOne(ROLES::class, ['ROLE_NAME' => 'USER_ROLE']);
    }

    public function setPassword($password){
        $this->PASSWORD = hash("sha256", $password);
    }

    public function validatePassword($password)
    {
        return strtoupper(hash("sha256", $password, false)) === $this->PASSWORD;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        //$this->authKey
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        //$this->authKey === $authKey
    }
}
