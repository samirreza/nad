<?php

namespace nad\factory\production\unit5\investigation5\instruction\models;

use nad\factory\production\unit5\investigation5\instruction\models\Instruction;
use nad\factory\production\unit5\investigation5\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'unit5';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit5/investigation5/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
