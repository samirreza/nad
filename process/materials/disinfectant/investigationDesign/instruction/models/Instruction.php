<?php

namespace nad\process\materials\disinfectant\investigationDesign\instruction\models;

use nad\process\materials\disinfectant\investigationDesign\instruction\models\Instruction;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\Instruction as BaseInstruction;

class Instruction extends BaseInstruction
{
    const CONSUMER_CODE = Instruction::class;

    public $moduleId = 'disinfectant';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/disinfectant/investigationDesign/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
