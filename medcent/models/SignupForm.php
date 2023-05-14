<?php

namespace app\models;

use Yii;
use app\models\Users;
use yii\base\Model;

class SignupForm extends Model
{
	public $email;
    public $password;
    
    private $rememberMe = true;
    private $_user = false;

	public function rules(){
		return[
			[['email','password'],'required','message' => 'Вы кое-что забыли!'],
			[['email'],'email','message' => 'Неправильный формат электронной почты'],
            [['email'],'validateEmail']
		];
	}

	public function attributeLabels() {
        return [
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    public function signup()
    {   
        if (!$this->getUser()) {
            $userId = (Users::find()->orderBy(['ID' => SORT_DESC])->one()->ID + 1);
            $newUser = new Users();
            $newUser->ID = $userId;
            $newUser->USER_ROLE = 'user';
            $newUser->EMAIL = $this->email;
            $newUser->setPassword($this->password);

            if ($newUser->save()) {
                return Yii::$app->user->login(Users::findOne(['EMAIL' => $this->email]), $this->rememberMe ? 3600*24*30 : 0);
            }
        }
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user) {
                $this->addError($attribute, 'Почта уже занята.');
            }
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findOne(['EMAIL' => $this->email]);
        }

        return $this->_user;
    }
}

?>
