<?php

namespace nad\common\modules\investigation\reference\behaviors;

use Yii;
use yii\helpers\Html;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class ReferenceBehavior extends \yii\base\Behavior
{
    private $references;

    public $moduleId;
    public $referenceClassName;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'attachReferences',
            ActiveRecord::EVENT_AFTER_UPDATE => 'attachReferences',
            ActiveRecord::EVENT_AFTER_DELETE => 'detachReferences'
        ];
    }

    public function setReferences($references)
    {
        $this->references = empty($references) ? [] : $references;
    }

    public function attachReferences()
    {
        if ($this->references === null) {
            return;
        }

        $this->detachReferences();

        foreach ($this->references as $reference) {
            $rows[] = [
                $reference,
                $this->moduleId,
                (new \ReflectionClass($this->owner))
                    ->getShortName(),
                $this->owner->id
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'nad_investigation_reference_relation',
                ['referenceId', 'moduleId', 'modelClassName', 'modelId'],
                $rows
            )->execute();
        }
    }

    public function detachReferences()
    {
        Yii::$app->db->createCommand()->delete('nad_investigation_reference_relation', [
            'moduleId' => $this->moduleId,
            'modelClassName' => (new \ReflectionClass($this->owner))
                ->getShortName(),
            'modelId' => $this->owner->id
        ])->execute();
    }

    public function getReferences()
    {
        return $this->referenceClassName::find()
            ->innerJoin(
                'nad_investigation_reference_relation',
                'nad_investigation_reference_relation.referenceId = nad_investigation_reference.id'
            )
            ->andWhere([
                'moduleId' => $this->moduleId,
                'modelClassName' => (new \ReflectionClass($this->owner))
                    ->getShortName(),
                'modelId' => $this->owner->id
            ])
            ->all();
    }

    public function getReferencesAsString()
    {
        $output = '';
        foreach ($this->owner->getReferences() as $reference) {
            $output .= $reference->title . ', ';
        }
        return rtrim($output, ', ');
    }

    public function getClickableReferencesAsString()
    {
        $output = '';
        foreach ($this->owner->getReferences() as $reference) {
            $output .= Html::a(
                $reference->title,
                $reference->getFile('resource')->getUrl(),
                [
                    'data-pjax' => '0',
                    'style' => 'margin:5px'
                ]) . ', ';
        }
        return rtrim($output, ', ');
    }
}
