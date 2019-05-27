<?php

namespace nad\extensions\graphGenerator\actions;

use yii\base\Action;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

class GenerateGraphAction extends Action
{
	public $viewName = "index";
	public $layout = false;
	public $modelClassName = null;

	public function init()
	{
		if (empty($this->modelClassName)) {
			throw new InvalidConfigException(
				'modelClassName property must be set.'
			);

		}
		parent::init();
	}

    public function run()
    {
    	$this->controller->layout = $this->layout;

		$model = new $this->modelClassName;
		$nodes = $model->getGraphNodes();
    	$links = $model->getGraphLinks();

		return $this->controller->renderAjax('@nad/extensions/graphGenerator/views/'.$this->viewName, [
			"nodes" => Json::encode($nodes),
			"links" => Json::encode($links),
		]);
    }

}
