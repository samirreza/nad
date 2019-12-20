<?php

namespace nad\common\code;

use yii\helpers\Html;
use yii\grid\DataColumn;
use nad\common\grid\Column;

class CodeGridColumn extends Column
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
        $this->contentOptions = ['style' => 'direction:ltr; font-family:Tahoma'];
        $this->filterInputOptions['style'] = [';direction:ltr; font-family:Tahoma'];
    }
}
