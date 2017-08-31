Tinymce Extension for Yii 2
========================

This extension provides **The Most Advanced WYSIWYG HTML Editor** [tinymce](https://www.tinymce.com/), called Gii, for [Yii framework 2.0](http://www.yiiframework.com) applications.

For license information check the [LICENSE](LICENSE.md)-file.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kant/yii2-tinymce
```

or add

```
"kant/yii2-tinymce": "~0.1"
```

to the require-dev section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
<?= $form->field($model, 'content')->textarea([
    //options
    ])->widget(TinymceWidget::class, [
        'clientOptions' => [
            'height' => '300px',
            //options
            ]
    ]); ?>

```

clientOptions are refered tinymce's official agruments:

see [tinymce/docs](https://www.tinymce.com/docs/configure/)