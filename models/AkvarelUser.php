<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 10:06
 * Created by JetBrains PhpStorm.
 */

namespace app\models;

use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;

/**
 * @property integer $age
 */
class AkvarelUser extends User
{
    /**
     * @return array
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['username'] = 'Имя пользователя';
        $labels['age'] = 'Возраст';
        return $labels;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return ArrayHelper::merge([
            ['age', 'integer'],
            ['age', 'default', 'value'=>null],
        ],parent::rules());
    }

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

    /**
     * Converts the object into an array.
     *
     * @param array $fields the fields that the output array should contain. Fields not specified
     * in [[fields()]] will be ignored. If this parameter is empty, all fields as specified in [[fields()]] will be returned.
     * @param array $expand the additional fields that the output array should contain.
     * Fields not specified in [[extraFields()]] will be ignored. If this parameter is empty, no extra fields
     * will be returned.
     * @param boolean $recursive whether to recursively return array representation of embedded objects.
     * @return array the array representation of the object
     */
    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        // TODO: Implement toArray() method.
    }
}
