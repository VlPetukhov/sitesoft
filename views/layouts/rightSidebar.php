<?php
/**
 * Template without sidebar
 *
 * @var $this yii\web\View
 * @var $content string
 */
use yii\widgets\Breadcrumbs;

$this->beginContent('@app/views/layouts/main.php');?>
    <section class="main col-sm-8">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php echo $content;?>
    </section>
    <aside class="col-sm-4">
        <?=$this->render('//layouts/sidebars/right');?>
    </aside>
<?php $this->endContent();?>