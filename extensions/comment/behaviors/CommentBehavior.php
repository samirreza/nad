<?php

namespace nad\extensions\comment\behaviors;

use yii\base\InvalidConfigException;
use nad\extensions\comment\models\Comment;

class CommentBehavior extends \yii\base\Behavior
{
    public $moduleId;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        parent::init();
    }

    public function getComments($sort = SORT_DESC)
    {
        return Comment::find()
            ->andWhere([
                'moduleId' => $this->moduleId,
                'modelClassName' => (new \ReflectionClass($this->owner))
                    ->getShortName(),
                'modelId' => $this->owner->id
            ])
            ->orderBy(['insertedAt' => $sort])
            ->all();
    }
}
