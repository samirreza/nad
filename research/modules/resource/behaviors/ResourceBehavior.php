<?php

namespace nad\research\modules\resource\behaviors;

use Yii;
use yii\helpers\Html;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use nad\research\modules\resource\models\Resource;

class ResourceBehavior extends Behavior
{
    private $resources;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'attachResources',
            ActiveRecord::EVENT_AFTER_UPDATE => 'attachResources',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteResources'
        ];
    }

    public function setResources($resources)
    {
        $this->resources = empty($resources) ? [] : $resources;
    }

    public function attachResources()
    {
        if ($this->resources === null) {
            return;
        }

        $this->deleteResources();

        foreach ($this->resources as $resource) {
            $rows[] = [
                $resource,
                (new \ReflectionClass($this->owner))
                    ->getShortName(),
                $this->owner->id
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'nad_research_resource_relation',
                ['resourceId', 'modelClassName', 'modelId'],
                $rows
            )->execute();
        }
    }

    public function deleteResources()
    {
        Yii::$app->db->createCommand()->delete('nad_research_resource_relation', [
            'modelClassName' => (new \ReflectionClass($this->owner))
                ->getShortName(),
            'modelId' => $this->owner->id
        ])->execute();
    }

    public function getResources()
    {
        return Resource::find()
            ->innerJoin(
                'nad_research_resource_relation',
                'nad_research_resource_relation.resourceId = nad_research_resource.id'
            )
            ->andWhere([
                'modelClassName' => (new \ReflectionClass($this->owner))
                    ->getShortName(),
                'modelId' => $this->owner->id
            ])
            ->all();
    }

    public function getResourcesAsArray()
    {
        return ArrayHelper::map($this->getResources(), 'id', 'title');
    }

    public function getClickableResourcesAsString()
    {
        $output = '';
        foreach ($this->getResources() as $resource) {
            $output .= Html::a(
                $resource->title,
                $resource->getFile('resource')->getUrl(),
                [
                    'data-pjax' => '0',
                    'style' => 'margin:5px'
                ]) . ', ';
        }
        return rtrim($output, ', ');
    }
}
