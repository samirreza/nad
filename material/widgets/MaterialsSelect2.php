<?php
namespace modules\nad\material\widgets;

use yii\helpers\Url;
use yii\web\JsExpression;

class MaterialsSelect2 extends \core\widgets\select2\Select2
{
    public function init()
    {
        $this->options = [
            'multiple' => true,
            'placeholder' => 'شروع به تایپ کنید..',
            'value' => $this->field->model->getMaterialsAsArray()
        ];
        $this->pluginOptions = [
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
                'url' => Url::to(['/material/type/manage/ajax-find-materials']),
                'dataType' => 'json',
                'delay' => 1000,
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'templateResult' => new JsExpression('function(material) { return material.text; }'),
        ];

        parent::init();
    }
}
