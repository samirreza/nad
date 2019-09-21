<?php
namespace nad\common\grid;

use yii\helpers\Html;
use nad\common\grid\Column;

class TitleColumn extends Column
{
    public $isAjaxGrid = false;

    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'title';
        }
        $this->format = 'raw';
        $this->value = function ($model) {
            $attribute = $this->attribute;
            return Html::a($model->$attribute, ['view', 'id'=>$model->id], [
                'title' => \Yii::t('yii', 'View'),
                'class' => $this->isAjaxGrid ? 'ajaxview' : ''
            ]);
        };
    }
}
