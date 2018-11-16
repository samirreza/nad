<?php

namespace nad\extensions\comment\widgets\commentList;


class CommentList extends \yii\base\Widget
{
    public $model;
    public $showDeleteButton = true;
    public $showCreateButton = true;
    public $sort = SORT_DESC;

    public function run()
    {
        return $this->render('view');
    }
}
