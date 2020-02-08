<?php

namespace nad\engineering\control\device\investigationImprovement\instruction\models;

use nad\engineering\control\device\investigationImprovement\instruction\models\Instruction;
use nad\engineering\control\device\investigationImprovement\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'device';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/device/investigationImprovement/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
