<?php

namespace nad\common\modules\investigation\common\behaviors;

use Yii;
use yii\db\Query;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class TaggableBehavior extends Behavior
{
    private $tags;

    public $moduleId;
    public $customOwner;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }

        parent::init();

        if (!isset($this->customOwner)) {
            $this->customOwner = $this->owner;
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'attachTags',
            ActiveRecord::EVENT_AFTER_UPDATE => 'attachTags',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteTags'
        ];
    }

    public function setTags($tags)
    {
        $this->tags = empty($tags) ? [] : $tags;
    }

    public function attachTags()
    {
        if ($this->tags === null) {
            return;
        }

        if (!$this->owner->isNewRecord) {
            $this->deleteTags();
        }

        foreach ($this->tags as $tag) {
            if (!$this->isTagExist($tag)) {
                $this->insertTag($tag);
            }
            $tagId = $this->getTagId($tag);
            $rows[] = [
                $tagId,
                $this->moduleId,
                (new \ReflectionClass($this->customOwner))
                    ->getShortName(),
                $this->owner->getPrimaryKey()
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'tag_module',
                ['tagId', 'moduleId', 'modelClassName', 'modelId'],
                $rows
            )->execute();
        }
    }

    public function deleteTags()
    {
        Yii::$app->db->createCommand()->delete('tag_module', [
            'moduleId' => $this->moduleId,
            'modelClassName' => (new \ReflectionClass($this->customOwner))
                ->getShortName(),
            'modelId' => $this->owner->getPrimaryKey()
        ])->execute();
    }

    public function getTags()
    {
        return $this->getTagsAsArray();
    }

    public function getTagsAsString()
    {
        return $this->getTagsAsArray() == [] ? ''
            : implode(', ', $this->getTagsAsArray());
    }

    public function getTagsAsArray()
    {
        if (!$this->owner->isNewRecord && $this->tags === null) {
            $this->tags = (new Query())
                ->select(['title'])
                ->from('tag')
                ->innerJoin('tag_module', 'tag.id = tag_module.tagId')
                ->where([
                    'moduleId' => $this->moduleId,
                    'modelClassName' => (new \ReflectionClass($this->customOwner))
                        ->getShortName(),
                    'modelId' => $this->owner->getPrimaryKey()
                ])
                ->column();
        }

        return $this->tags == null ? [] : $this->tags;
    }

    private function isTagExist($tag)
    {
        return (new Query())
            ->from('tag')
            ->where(['title' => $tag])
            ->exists();
    }

    private function insertTag($tag)
    {
        Yii::$app->db->createCommand()->insert('tag', [
            'title' => $tag
        ])->execute();
    }

    private function getTagId($tag)
    {
        return (new Query())
            ->select(['id'])
            ->from('tag')
            ->where(['title' => $tag])
            ->scalar();
    }

    // from TaggableQueryBehavior

    public function getModelIdsHaveAnyTags($tagTitles)
    {
        if (!$tagTitles) {
            return '';
        }else{
            $tagTitles = $this->prepareTagTitles($tagTitles);
        }

        return (new Query())
            ->select(['modelId'])
            ->distinct()
            ->from('tag_module')
            ->where([
                'moduleId' => $this->moduleId,
                'modelClassName' => (new \ReflectionClass($this->customOwner))
                ->getShortName()
            ])
            ->andWhere(['in', 'tagId', $this->getTagIds($tagTitles)])
            ->column();
    }

    public function getModelIdsHaveExactTags($tagTitles)
    {
        if (!$tagTitles) {
            return '';
        }else{
            $tagTitles = $this->prepareTagTitles($tagTitles);
        }

        return (new Query())
            ->select(['modelId'])
            ->distinct()
            ->from('tag_module')
            ->where([
                'moduleId' => $this->moduleId,
                'modelClassName' => (new \ReflectionClass($this->customOwner))
                ->getShortName()
            ])
            ->andWhere(['in', 'tagId', $this->getTagIds($tagTitles)])
            ->groupBy('modelId')
            ->having('COUNT(modelId) = ' . count($tagTitles))
            ->column();
    }

    private function getTagIds($tagTitles)
    {
        return (new \yii\db\Query())
            ->select('id')
            ->from('tag')
            ->andWhere(['in', 'title', $tagTitles])
            ->column();
    }

    public function prepareTagTitles($tagTitles){
        return array_map(function($item) {
            return trim($item);
        }, explode('-', $tagTitles));
    }
}
