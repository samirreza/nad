<?php

namespace nad\common\modules\investigation\report\notifications;

use extensions\notification\Notification;
use nad\common\modules\investigation\report\models\ReportCommon;

class ReportAssignNotification extends Notification
{
    public $report;
    public $moduleId = 'report';
    public $category = 'گزارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        // switch ($this->report->status) {
        //     case ReportCommon::STATUS_IN_NEXT_STEP :
        //         $this->category .= ' منشا';
        //         break;
        //     case ReportCommon::STATUS_IN_NEXT_STEP_FOR_METHOD :
        //         $this->category .= ' روش';
        //         break;
        //     case ReportCommon::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION :
        //         $this->category .= ' دستورالعمل';
        //         break;
        //     case ReportCommon::STATUS_IN_NEXT_STEP_FOR_SOURCE_METHOD :
        //         $this->category .= ' منشا/روش';
        //         break;
        //     case ReportCommon::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION :
        //         $this->category .= ' منشا/دستورالعمل';
        //         break;
        //     case ReportCommon::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION :
        //         $this->category .= ' روش/دستورالعمل';
        //         break;
        //     case ReportCommon::STATUS_IN_NEXT_STEP_FOR_SOURCE_METHOD_INSTRUCTION :
        //         $this->category .= ' منشا/روش/دستورالعمل';
        //         break;
        //     default:
        //         break;
        // }
        return "{$this->report->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->report->id
        ];
    }
}
