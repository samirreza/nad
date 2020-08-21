<?php

namespace nad\extensions\comment\widgets\commentList;

use yii\base\InvalidConfigException;

class CommentList extends \yii\base\Widget
{
    public $model;
    public $moduleId;
    public $showEditDeleteButton = true;
    public $showCreateButton = true;
    public $sort = SORT_DESC;
    public $visible = true;
    public $returnUrl;
    public $comments = null;
    public $readonly = false;
    public $showReceiver = false;

    public function init()
    {
        if (empty($this->model)) {
            throw new InvalidConfigException('model property must be set.');
        }
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        if(!isset($this->comments)){
            $this->comments = $this->model->getComments($this->sort);
        }
        parent::init();
    }

    public function run()
    {
        if (!$this->visible) {
            return;
        }
        return $this->render('view', [
            'comments' => $this->comments,
            'readonly' => $this->readonly,
            'showReceiver' => $this->showReceiver
            ]);
    }
}
