<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 10:06
 * Created by JetBrains PhpStorm.
 */

namespace app\models;

use webvimark\modules\UserManagement\models\User;

class AkvarelUser extends User
{
    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => User::STATUS_ACTIVE]);
    }
}
