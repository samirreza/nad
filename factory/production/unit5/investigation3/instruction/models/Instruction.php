<?php

namespace nad\factory\production\unit5\investigation3\instruction\models;

use nad\factory\production\unit5\investigation3\instruction\models\Instruction;
use nad\factory\production\unit5\investigation3\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\Instruction as BaseInstruction;

class Instruction extends BaseInstruction
{
    const CONSUMER_CODE = Instruction::class;

    public $moduleId = 'unit5';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/unit5/investigation3/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
