<?php

namespace nad\research\modules\source\behaviors;

use Yii;
use yii\db\Query;
use yii\db\ActiveRecord;
use modules\user\common\models\User;

class ExpertsBehavior extends \yii\base\Behavior
{
    private $experts;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'insertExperts',
            ActiveRecord::EVENT_AFTER_UPDATE => 'insertExperts',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteExperts'
        ];
    }

    public function setExperts($experts)
    {
        $this->experts = $experts;
    }

    public function getExperts()
    {
        if (!$this->owner->isNewRecord && $this->experts === null) {
            $this->experts = (new Query())
                ->select(['userId'])
                ->from('nad_research_source_expert_relation')
                ->where([
                    'sourceId' => $this->owner->getPrimaryKey()
                ])
                ->column();
        }

        return $this->experts == null ? [] : $this->experts;
    }

    public function insertExperts()
    {
        if (empty($this->experts)) {
            return;
        }

        if (!$this->owner->isNewRecord) {
            $this->deleteExperts();
        }

        foreach ($this->experts as $expert) {
            $rows[] = [
                $expert,
                $this->owner->getPrimaryKey()
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'nad_research_source_expert_relation',
                ['userId', 'sourceId'],
                $rows
            )->execute();
        }
    }

    public function deleteExperts()
    {
        Yii::$app->db->createCommand()->delete('nad_research_source_expert_relation', [
            'sourceId' => $this->owner->getPrimaryKey()
        ])->execute();
    }

    public function getExpertEmailsAsString()
    {
        $emails = '';
        foreach ($this->getExperts() as $expertId) {
            $emails .= User::findOne($expertId)->email . ', ';
        }
        return trim($emails, ', ');
    }

    public function hasAnyExpert()
    {
        return (new Query())
            ->from('nad_research_source_expert_relation')
            ->where([
                'sourceId' => $this->owner->getPrimaryKey()
            ])
            ->exists();
    }

    public function hasExpert($userId)
    {
        return (new Query())
            ->from('nad_research_source_expert_relation')
            ->where([
                'userId' => $userId,
                'sourceId' => $this->owner->getPrimaryKey()
            ])
            ->exists();
    }
}
