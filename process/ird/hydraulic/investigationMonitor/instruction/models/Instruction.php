<?php

namespace nad\process\ird\hydraulic\investigationMonitor\instruction\models;

use nad\process\ird\hydraulic\investigationMonitor\instruction\models\Instruction;
use nad\process\ird\hydraulic\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\Instruction as BaseInstruction;

class Instruction extends BaseInstruction
{
    const CONSUMER_CODE = Instruction::class;

    public $moduleId = 'hydraulic';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/hydraulic/investigationMonitor/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
