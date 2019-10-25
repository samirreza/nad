<?php

namespace nad\common\modules\investigation\proposal\notifications;

use extensions\notification\Notification;
use nad\common\modules\investigation\proposal\models\ProposalCommon;

class ProposalAssignNotification extends Notification
{
    public $proposal;
    public $moduleId = 'proposal';
    public $category = 'نگارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        switch ($this->proposal->status) {
            case ProposalCommon::STATUS_IN_NEXT_STEP :
                $this->category .= ' گزارش';
                break;
            case ProposalCommon::STATUS_IN_NEXT_STEP_FOR_METHOD :
                $this->category .= ' روش';
                break;
            case ProposalCommon::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION :
                $this->category .= ' دستورالعمل';
                break;
            case ProposalCommon::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD :
                $this->category .= ' گزارش/روش';
                break;
            case ProposalCommon::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION :
                $this->category .= ' گزارش/دستورالعمل';
                break;
            case ProposalCommon::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION :
                $this->category .= ' روش/دستورالعمل';
                break;
            case ProposalCommon::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION :
                $this->category .= ' گزارش/روش/دستورالعمل';
                break;
            default:
                break;
        }
        return "پروپوزال «{$this->proposal->title}» برای {$this->category} به شما تحویل داده شد.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->proposal->id
        ];
    }
}
