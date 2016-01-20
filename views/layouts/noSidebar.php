<?php
/**
 * Template without sidebar
 *
 * @var $this yii\web\View
 * @var $content string
 */
use yii\widgets\Breadcrumbs;

$this->beginContent('@app/views/layouts/main.php');?>
    <section class="main">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php echo $content;?>
    </section>
<?php $this->endContent();?>