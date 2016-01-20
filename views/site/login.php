<?php
/**
 * login form
 *
 * @var $this yii\web\View
 * @var $model app\models\LoginForm
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6">
        <?php
        $form = ActiveForm::begin();
        echo $form->field($model, 'email');
        echo $form->field($model, 'password')->passwordInput();
        ?>
        <div class="form-group">
            <?= Html::submitButton(
                'Войти',
                [
                    'class' => 'btn btn-primary',
                    'name' => 'signup-button'
                ]); ?>
        </div>
        <?php $form->end(); ?>
    </div>
</div>