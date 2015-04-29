<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 9:39
 * Created by JetBrains PhpStorm.
 */

/* @var $this yii\web\View */
/* @var $model \webvimark\modules\UserManagement\models\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Ваш профиль</h3></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
                <?= $form->field($model,'username') ?>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>