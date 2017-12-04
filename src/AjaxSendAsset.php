<?php

namespace rebzden\ajaxsend;


use yii\web\AssetBundle;

class AjaxSendAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = __DIR__ . '/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/ajaxsend.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
    ];
}