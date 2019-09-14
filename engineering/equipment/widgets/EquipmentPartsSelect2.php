<?php

namespace nad\engineering\equipment\widgets;

use yii\helpers\Url;
use yii\web\JsExpression;
use core\widgets\select2\Select2;

class EquipmentPartsSelect2 extends Select2
{
    public function init()
    {
        $this->options = [
            'multiple' => true,
            'placeholder' => 'شروع به تایپ کنید..',
            'value' => $this->field->model->getPartsAsArray()
        ];
        $this->pluginOptions = [
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
                'url' => Url::to(['/engineering/equipment/type/details/part/ajax-find-parts']),
                'dataType' => 'json',
                'delay' => 1000,
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'templateResult' => new JsExpression('function(part) { return part.text; }')
        ];
        parent::init();
    }
}
