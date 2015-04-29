<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 29.04.15
 * @time 8:29
 * Created by JetBrains PhpStorm.
 */

/* @var $this yii\web\View */
/* @var $model app\models\AkvarelLoginForm */
/* @var $form yii\bootstrap\ActiveForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Введите свой код подтверждения</h3></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['id' => 'login-form-step-2']); ?>
                <?= $form->field($model,'email',['template'=>'{input}'])->hiddenInput() ?>
                <?= $form->field($model,'pin') ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>