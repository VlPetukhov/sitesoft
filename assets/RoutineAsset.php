<?php
namespace app\assets;

use yii\web\AssetBundle;

class RoutineAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/routine.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
