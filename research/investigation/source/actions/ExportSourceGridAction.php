<?php

namespace nad\research\investigation\source\actions;

use core\grid\actions\ExportGridAction;
use nad\research\investigation\source\models\Source;
use nad\research\investigation\source\models\SourceSearch;

class ExportSourceGridAction extends ExportGridAction
{
    public function init()
    {
        $this->fileName = 'source';
        $this->searchClass = SourceSearch::class;
        $this->columns = [
            'title',
            'englishTitle',
            'uniqueCode',
            [
                'attribute' => 'createdBy',
                'value' => function ($model) {
                    return $model->researcher->fullName;
                }
            ],
            [
                'attribute' => 'mainReasonId',
                'value' => function ($model) {
                    return $model->mainReason->title;
                }
            ],
            'createdAt:date',
            'reasons',
            [
                'attribute' => 'tags',
                'value' => function ($model) {
                    return $model->getTagsAsString();
                }
            ],
            'deliverToManagerDate:date',
            'sessionDate:dateTime',
            [
                'attribute' => 'experts',
                'value' => function ($model) {
                    return $model->getExpertFullNamesAsString();
                }
            ],
            'updatedAt:date',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Source::getStatusLables()[$model->status];
                }
            ]
        ];
        parent::init();
    }
}
