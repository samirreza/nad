<?php

namespace nad\seaport\wayside\unit1\investigation1\instruction\models;

use nad\seaport\wayside\unit1\investigation1\instruction\models\Instruction;
use nad\seaport\wayside\unit1\investigation1\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\Instruction as BaseInstruction;

class Instruction extends BaseInstruction
{
    const CONSUMER_CODE = Instruction::class;

    public $moduleId = 'unit1';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/unit1/investigation1/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
