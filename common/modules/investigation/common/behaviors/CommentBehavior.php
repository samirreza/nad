<?php

namespace nad\common\modules\investigation\common\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;
use nad\extensions\comment\models\Comment;

class CommentBehavior extends \yii\base\Behavior
{
    public $moduleId;
    public $customOwner;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        if (!isset($this->customOwner)) {
            $this->customOwner = $this->owner;
        }
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteComments'
        ];
    }

    public function deleteComments()
    {
        Yii::$app->db->createCommand()->delete('comment', [
            'moduleId' => $this->moduleId,
            'modelClassName' => (new \ReflectionClass($this->customOwner))
                ->getShortName(),
            'modelId' => $this->owner->getPrimaryKey()
        ])->execute();
    }

    public function getComments($sort = SORT_DESC)
    {
        return Comment::find()
            ->andWhere([
                'moduleId' => $this->moduleId,
                'modelClassName' => (new \ReflectionClass($this->customOwner))
                    ->getShortName(),
                'modelId' => $this->owner->id
            ])
            ->orderBy(['insertedAt' => $sort])
            ->all();
    }
}
