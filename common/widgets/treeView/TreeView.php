<?php

namespace nad\common\widgets\treeView;

use yii\helpers\Json;

class TreeView extends \yii\base\Widget
{
    public $jsOptions;
    public $title = 'نمایش درختی';

    public function run()
    {
        $this->setJsOption();
        return $this->render('tree', [
            'jsOptions' => Json::encode($this->jsOptions)
        ]);
    }

    private function setJsOption()
    {
        if (!isset($this->jsOptions['autoOpen'])) {
            $this->jsOptions['autoOpen'] = false;
        }
        if (!isset($this->jsOptions['autoEscape'])) {
            $this->jsOptions['autoEscape'] = false;
        }
        if (!isset($this->jsOptions['selectable'])) {
            $this->jsOptions['selectable'] = false;
        }
        if (!isset($this->jsOptions['rtl'])) {
            $this->jsOptions['rtl'] = true;
        }
    }
}
