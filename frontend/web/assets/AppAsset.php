<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bui.css',
        'css/dpl.css',
        'css/ie_style.css',
        'css/layout.css',
        'css/style.css',
        'css/dandelion.css',
		//'css/icon.css',
		//'css/index.css',
    ];
    public $js = [
        'js/jquery-1.4.2.min.js',
        'js/chart.js',
        'js/cufon-replace.js',
        'js/cufon-yui.js',
        'js/Myirad_Pro_400.font.js',
        'js/Myriad_Pro_600.font.js',
		'js/slider.js',
        
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
