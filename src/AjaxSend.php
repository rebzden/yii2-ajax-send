<?php

namespace rebzden\ajaxsend;


use yii\base\Widget;
use yii\helpers\Json;
use yii\web\View;

class AjaxSend extends Widget
{

    /**
     * [
     *     [
     *          'selector'  => '.checkbox',
     *          'url'       =>  Url::to(['/guest-preferences/create', 'id' => $model->id]),
     *          'trigger'   => 'change click',
     *          'afterSend' => 'function(response){toast.showMessage(response);}
     *     ],
     *     [
     *          'selector'      => '.checkbox',
     *          'urlAttribute'  =>  'data-url',
     *          'trigger'       => 'change click',
     *          'afterSend'     => 'function(response){toast.showMessage(response);}
     *     ],
     * ]
     * @var array
     */
    public $selectors = [];

    public function run()
    {
        $this->registerAssets();
        return parent::run();
    }

    protected function registerAssets()
    {
        $view = $this->getView();
        AjaxSendAsset::register($view);

        $selectors = Json::encode($this->selectors);

        $view->registerJs("
        if (typeof ajaxSend === 'undefined') {
            ajaxSend = new AjaxSend({$selectors})
        }else{
            ajaxSend.addSelectors({$selectors});
        }");
    }
}