<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace kant\tinymce;

use yii\web\AssetBundle;

class TinymceAsset extends AssetBundle
{

    public $js = [
        'tinymce.min.js'
    ];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
    }
}
