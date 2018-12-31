<?php

namespace nad\research\modules\proposal\behaviors;

use Yii;
use yii\db\Query;
use yii\db\ActiveRecord;
use modules\user\common\models\User;

class PartnersBehavior extends \yii\base\Behavior
{
    private $partners;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'insertPartners',
            ActiveRecord::EVENT_AFTER_UPDATE => 'insertPartners',
            ActiveRecord::EVENT_AFTER_DELETE => 'deletePartners'
        ];
    }

    public function setPartners($partners)
    {
        $this->partners = empty($partners) ? [] : $partners;
    }

    public function getPartners()
    {
        if (!$this->owner->isNewRecord && $this->partners === null) {
            $this->partners = (new Query())
                ->select(['userId'])
                ->from('nad_research_proposal_partner_relation')
                ->where([
                    'proposalId' => $this->owner->getPrimaryKey()
                ])
                ->column();
        }

        return $this->partners == null ? [] : $this->partners;
    }

    public function insertPartners()
    {
        if (empty($this->partners)) {
            return;
        }

        if (!$this->owner->isNewRecord) {
            $this->deletePartners();
        }

        foreach ($this->partners as $partner) {
            $rows[] = [
                $partner,
                $this->owner->getPrimaryKey()
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'nad_research_proposal_partner_relation',
                ['userId', 'proposalId'],
                $rows
            )->execute();
        }
    }

    public function deletePartners()
    {
        Yii::$app->db->createCommand()->delete('nad_research_proposal_partner_relation', [
            'proposalId' => $this->owner->getPrimaryKey()
        ])->execute();
    }

    public function getPartnerEmailsAsString()
    {
        $emails = '';
        foreach ($this->getPartners() as $partner) {
            $emails .= User::findOne($partner)->email . ', ';
        }
        return trim($emails, ', ');
    }
}
