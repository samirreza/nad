<?php

namespace nad\engineering\equipment\widgets;

use yii\helpers\Url;
use yii\web\JsExpression;
use core\widgets\select2\Select2;

class EquipmentsSelect2 extends Select2
{
    public function init()
    {
        $this->options = [
            'multiple' => true,
            'placeholder' => 'شروع به تایپ کنید..',
            'value' => $this->field->model->getEquipmentsAsArray()
        ];
        $this->pluginOptions = [
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
                'url' => Url::to(['/equipment/type/manage/ajax-find-equipments']),
                'dataType' => 'json',
                'delay' => 1000,
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'templateResult' => new JsExpression('function(equipment) { return equipment.text; }')
        ];

        parent::init();
    }
}
