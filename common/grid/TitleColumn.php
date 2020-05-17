<?php
namespace nad\common\grid;

use yii\helpers\Html;
use nad\common\grid\Column;

class TitleColumn extends Column
{
    public $isAjaxGrid = false;
    public $useHyperLink = true;

    public function init()
    {
        if (!isset($this->attribute)) {
            $this->attribute = 'title';
        }
        $this->format = 'raw';
        $this->value = function ($model) {
            $attribute = $this->attribute;
            if($this->useHyperLink){
                return Html::a($model->$attribute, ['view', 'id'=>$model->id], [
                    'title' => \Yii::t('yii', 'View'),
                    'class' => $this->isAjaxGrid ? 'ajaxview' : ''
                ]);
            }else{
                return $model->$attribute;
            }
        };
    }
}
