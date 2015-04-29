<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 6:52
 * Created by JetBrains PhpStorm.
 */
namespace app\components;

use webvimark\modules\UserManagement\components\UserConfig as BaseUserConfig;

class UserConfig extends BaseUserConfig
{
    public $identityClass = 'app\models\AkvarelUser';

    public $loginUrl = ['default/login'];
}
