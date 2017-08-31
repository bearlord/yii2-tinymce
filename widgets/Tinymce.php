<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace kant\tinymce\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\tinymce\TinymceAsset;
use yii\tinymce\TinymceLangAsset;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Tinymce widget provides WYSIWYG HTML Editor implementation for InputWidget.
 *
 *
 * @author Zhenqiang Zhang <zhenqiang.zhang@gmail.com>
 * @since 2.0
 */
class Tinymce extends InputWidget
{

    public $clientOptions = [];

    public $convention = [
        'plugins' => 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker table contextmenu directionality emoticons paste textcolor',
        'toolbar' => 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | image | media | link unlink anchor | print preview code  | forecolor backcolor'
    ];

    public function init()
    {
        parent::init();
        $this->id = $this->options['id'];
    }

    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, [
                'id' => $this->id
            ]);
        } else {
            return Html::textarea($this->id, $this->value, [
                'id' => $this->id
            ]);
        }
    }

    /**
     * Register client scripts
     */
    protected function registerClientScript()
    {
        $this->formatClientOptions();
        TinymceAsset::register($this->view);
        TinymceLangAsset::register($this->view);
        $clientOptions = Json::encode($this->clientOptions);
        $script = "tinymce.init(" . $clientOptions . ");";
        $this->view->registerJs($script);
    }

    protected function formatClientOptions()
    {
        $this->setFilemanager();
        if (empty($this->clientOptions)) {
            $this->clientOptions = $this->clientOptions;
        }
        $this->clientOptions['selector'] = "#" . $this->id;

    }

    protected function setFilemanager()
    {
        if (!empty($this->clientOptions['filemanager'])) {
            $this->convention['plugins'] .= ' responsivefilemanager';
            $this->convention['toolbar'] .= ' | responsivefilemanager';
            $this->convention['image_advtab'] = true;
            $this->convention['relative_urls'] = false;
            $this->convention['external_filemanager_path'] = $this->clientOptions['filemanager'];
            $this->convention['file_picker_types'] = 'file image media';
            $this->convention['file_picker_callback'] = new JsExpression('function(cb,value,meta){var width=window.innerWidth-30;var height=window.innerHeight-60;if(width>1800)width=1800;if(height>1200)height=1200;if(width>600){var width_reduce=(width-20)%138;width=width-width_reduce+10}var urltype=2;if(meta.filetype=="image"){urltype=1}if(meta.filetype=="media"){urltype=3}var title="RESPONSIVE FileManager";if(typeof this.settings.filemanager_title!=="undefined"&&this.settings.filemanager_title){title=this.settings.filemanager_title}var akey="key";if(typeof this.settings.filemanager_access_key!=="undefined"&&this.settings.filemanager_access_key){akey=this.settings.filemanager_access_key}var sort_by="";if(typeof this.settings.filemanager_sort_by!=="undefined"&&this.settings.filemanager_sort_by){sort_by="&sort_by="+this.settings.filemanager_sort_by}var descending="false";if(typeof this.settings.filemanager_descending!=="undefined"&&this.settings.filemanager_descending){descending=this.settings.filemanager_descending}var fldr="";if(typeof this.settings.filemanager_subfolder!=="undefined"&&this.settings.filemanager_subfolder){fldr="&fldr="+this.settings.filemanager_subfolder}var crossdomain="";if(typeof this.settings.filemanager_crossdomain!=="undefined"&&this.settings.filemanager_crossdomain){crossdomain="&crossdomain=1";if(window.addEventListener){window.addEventListener("message",filemanager_onMessage,false)}else{window.attachEvent("onmessage",filemanager_onMessage)}}tinymce.activeEditor.windowManager.open({title:title,file:this.settings.external_filemanager_path+"?type="+urltype+"&descending="+descending+sort_by+fldr+crossdomain+"&lang="+this.settings.language+"&akey="+akey,width:width,height:height,resizable:true,maximizable:true,inline:1},{setUrl:function(url){cb(url)}})}');
        }
    }
}
