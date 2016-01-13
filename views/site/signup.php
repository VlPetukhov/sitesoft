<?php
/**
 * Sign up form
 *
 * @var $this yii\web\View
 * @var $model app\models\signUpForm
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Регистрация нового пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="user-signup">
    <h1>Регестрация нового пользователя</h1>

    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin();?>
            <?= $form->field($model, 'email'); ?>
            <?= $form->field($model, 'name'); ?>
            <?= $form->field($model, 'password')->passwordInput(); ?>
            <?= $form->field($model, 'password_repeat')->passwordInput(); ?>
            <div class="form-group">
                <?= Html::submitButton(
                    'Зарегистрироваться!',
                    [
                        'class' => 'btn btn-primary',
                        'name' => 'signup-button'
                    ]); ?>
            </div>
            <?php $form->end();?>
        </div>
    </div>
</div>