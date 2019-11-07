<?php

namespace nad\process\ird\sedimentation\investigationMonitor\instruction\models;

use nad\process\ird\sedimentation\investigationMonitor\instruction\models\Instruction;
use nad\process\ird\sedimentation\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'sedimentation';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/sedimentation/investigationMonitor/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
