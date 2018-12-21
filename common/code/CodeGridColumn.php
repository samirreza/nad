<?php

namespace nad\common\code;

use yii\helpers\Html;
use yii\grid\DataColumn;

class CodeGridColumn extends DataColumn
{
    public $isAjaxGrid = false;

    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'uniqueCode';
        }
        if (empty($this->options)) {
            $this->options = ['style' => 'width:20%'];
        }
        $this->format = 'raw';
        $this->contentOptions = ['style' => 'direction:ltr'];
        $this->value = function ($model) {
            $attribute = $this->attribute;
            return Html::a($model->$attribute, ['view', 'id' => $model->id], [
                'title' => \Yii::t('yii', 'View'),
                'class' => $this->isAjaxGrid ? 'ajaxview' : ''
            ]);
        };
    }
}
