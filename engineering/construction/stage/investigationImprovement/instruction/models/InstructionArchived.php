<?php

namespace nad\engineering\construction\stage\investigationImprovement\instruction\models;

use nad\engineering\construction\stage\investigationImprovement\instruction\models\Instruction;
use nad\engineering\construction\stage\investigationImprovement\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/stage/investigationImprovement/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
