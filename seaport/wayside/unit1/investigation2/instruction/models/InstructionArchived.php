<?php

namespace nad\seaport\wayside\unit1\investigation2\instruction\models;

use nad\seaport\wayside\unit1\investigation2\instruction\models\Instruction;
use nad\seaport\wayside\unit1\investigation2\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'unit1';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit1/investigation2/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
