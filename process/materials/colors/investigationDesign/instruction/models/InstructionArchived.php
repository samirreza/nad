<?php

namespace nad\process\materials\colors\investigationDesign\instruction\models;

use nad\process\materials\colors\investigationDesign\instruction\models\Instruction;
use nad\process\materials\colors\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'colors';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/colors/investigationDesign/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
