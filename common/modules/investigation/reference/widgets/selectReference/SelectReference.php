<?php

namespace nad\common\modules\investigation\reference\widgets\selectReference;

use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use yii\base\InvalidConfigException;
use nad\common\modules\investigation\reference\models\Reference;

class SelectReference extends Select2
{
    public $consumer;

    public function init()
    {
        if ($this->consumer === null) {
            throw new InvalidConfigException('consumer property must be set.');
        }

        if (!isset($this->data)) {
            $this->data = ArrayHelper::map(
                Reference::find()
                    ->andWhere(['consumer' => $this->consumer])
                    ->all(),
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
