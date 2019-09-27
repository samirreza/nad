<?php

namespace nad\common\modules\investigation\reference\widgets\selectReference;

use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use yii\base\InvalidConfigException;
use nad\common\modules\investigation\reference\models\Reference;

class SelectReference extends Select2
{
    public $consumer;
    public $code;

    public function init()
    {
        if ($this->consumer === null) {
            throw new InvalidConfigException('consumer property must be set.');
        }

        if (!isset($this->data)) {
            $query = Reference::find();
            if(isset($this->code)){
                $query = $query->joinWith(['referenceUses'])->andWhere(['code' => $this->code]);
            }

            $this->data = ArrayHelper::map(
                $query->andWhere(['consumer' => $this->consumer])->all(),
                'id',
                'codedTitle'
            );
        }
        if (!isset($this->options['placeholder'])) {
            $this->options['placeholder'] = 'منبع را انتخاب کنید ...';
        }
        if (!isset($this->options['multiple'])) {
            $this->options['multiple'] = true;
        }
        if (!isset($this->pluginOptions['allowClear'])) {
            $this->pluginOptions['allowClear'] = true;
        }
        parent::init();
    }
}
