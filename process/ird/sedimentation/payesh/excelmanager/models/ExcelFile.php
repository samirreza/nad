<?php

namespace nad\process\ird\sedimentation\payesh\excelmanager\models;

use nad\common\modules\excelmanager\models\ExcelFile as BaseExcelFile;

class ExcelFile extends BaseExcelFile
{
    const CONSUMER_CODE = ExcelFile::class;

    public $moduleId = 'excelmanager';

    public function getBaseViewRoute()
    {
        return '/engineering/piping/stage/payesh/excelmanager/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_excel_file.consumer' => self::CONSUMER_CODE]);
    }
}
