<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 6:24
 * Created by JetBrains PhpStorm.
 */
namespace app\controllers;

use Yii;
use app\controllers\BaseRBACController;
use app\models\AkvarelLoginForm;

class DefaultController extends BaseRBACController
{
    public $layout = 'akvarel';

    public $freeAccessActions = ['index','profile','logout'];

    public function actionIndex(){
        if(!Yii::$app->user->isGuest){
            return $this->redirect('profile');
        }
        return $this->render('index');
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->redirect('/');
    }

    public function actionLogin(){
        if(!Yii::$app->user->isGuest){
            $this->redirect('profile');
        }
        $step = Yii::$app->session->get("login-step",1);
        $model = new AkvarelLoginForm();
        if(Yii::$app->request->isPost){
            if(isset($_POST['AkvarelLoginForm'])){
                switch($step){
                    case 1:
                        $model->setScenario('login-step_1');
                        if($model->load(Yii::$app->request->post()) && $model->validate()){
                            $user = $model->getUser();
                            /** Если пользователя еще нет - создаем его */
                            if($user->isNewRecord){
                                $user->username = $model->email;
                                $user->email = $model->email;
                            }
                            $user->password = mt_rand(100000,999999);
                            $user->save(false);
                            $message = Yii::$app->mailer->compose();
                            $message->setFrom(Yii::$app->params['adminEmail'])
                                ->setTo($user->email)
                                ->setSubject('Код подтверждения для авторизации на сайте')
                                ->setHtmlBody('Ваш код подтверждения - <strong>'.$user->password.'</strong>');
                            if($message->send())
                            {
                                $step = 2;
                                Yii::$app->session->set("login-step",$step);
                                Yii::$app->session->set("login-email",$model->email);
                            }
                            else
                            {
                                $model->addError('email','Не удалось отправить письмо на указанный адрес');
                            }
                        }
                        break;
                    case 2:
                        $model->setScenario('login-step_2');
                        if($model->load(Yii::$app->request->post()) && $model->validate()){
                            $model->email = Yii::$app->session->get("login-email");
                            $user = $model->getUser();
                            if($user->isNewRecord){
                                Yii::$app->session->set("login-step",1);
                                $this->redirect('login');
                            }
                            if(!$user->validatePassword($model->pin)){
                                $model->addError('pin','Код подтверждения не совпадает');
                            } elseif(Yii::$app->user->login($user)){
                                $this->redirect('profile');
                            }
                        } elseif (!isset($model->email)){
                            Yii::$app->session->set("login-step",1);
                            $this->redirect('login');
                        }
                        break;
                }
            }
        }
        return $this->render('login/step_'.$step,[
            'model' => $model,
        ]);
    }

    public function actionProfile(){
        if(Yii::$app->user->isGuest){
            return $this->redirect('login');
        }
        /** @var $user \app\models\AkvarelUser */
        $user = Yii::$app->user->getIdentity();
        if(Yii::$app->request->isPost){
            $user->load(Yii::$app->request->post());
            $user->save();
        }
        return $this->render('profile',['model'=>$user]);
    }
}