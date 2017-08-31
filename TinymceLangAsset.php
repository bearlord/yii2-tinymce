<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace kant\tinymce;

use Yii;
use yii\web\AssetBundle;

class TinymceLangAsset extends AssetBundle
{

    public $js = [];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets\\langs\\';
        $jsFileName = Yii::$app->language . ".js";
        if (file_exists($this->sourcePath . $jsFileName)) {
            $this->js = [
                Yii::$app->language . ".js"
            ];
        }
    }
}
