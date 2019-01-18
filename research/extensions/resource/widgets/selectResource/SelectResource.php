<?php

namespace nad\research\extensions\resource\widgets\selectResource;

use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use yii\base\InvalidConfigException;
use nad\research\extensions\resource\models\Resource;

class SelectResource extends Select2
{
    public $clientId;

    public function init()
    {
        if ($this->clientId === null) {
            throw new InvalidConfigException('clientId property must be set.');
        }

        if (!isset($this->data)) {
            $this->data = ArrayHelper::map(
                Resource::find()
                    ->andWhere(['clientId' => $this->clientId])
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
