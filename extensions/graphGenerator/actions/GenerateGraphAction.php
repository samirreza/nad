<?php

namespace nad\extensions\graphGenerator\actions;

use yii\base\Action;

class GenerateGraphAction extends Action
{
	public $viewName = "index";
	public $layout = false;

    public function run()
    {
    	$this->controller->layout = $this->layout;    	

        return $this->controller->renderAjax('@nad/extensions/graphGenerator/views/'.$this->viewName);
    }
}