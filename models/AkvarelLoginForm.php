<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 7:17
 * Created by JetBrains PhpStorm.
 */
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\AkvarelUser as User;

class AkvarelLoginForm extends Model
{
    public $email;
    public $pin;

    private $_user;

    public function scenarios()
    {
        return [
            'login-step_1' => ['email'],
            'login-step_2' => ['email', 'pin'],
        ];
    }

    public function rules()
    {
        return [
            [['email'], 'email'],
            [['pin'], 'integer'],
            [['email'], 'required', 'on' => 'login-step_1'],
            [['email', 'pin'], 'required', 'on' => 'login-step_1'],
        ];
    }

    public function attributeLabels(){
        return [
            'email' => 'Email',
            'pin' => 'Код подтверждения',
        ];
    }

    public function getUser(){
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
            if($this->_user === null){
                $this->_user = new User();
            }
        }

        return $this->_user;
    }
}
