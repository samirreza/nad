<?php

namespace nad\research\modules\source\models;

use yii\data\ActiveDataProvider;
use extensions\i18n\validators\JalaliDateToTimestamp;

class SourceSearch extends Source
{
    public $beginDate;
    public $endDate;

    public function rules()
    {
        return [
            [
                ['title', 'englishTitle', 'uniqueCode', 'reason', 'necessity'],
                'string'
            ],
            [['id', 'createdBy', 'mainReasonId', 'status'], 'integer'],
            ['tags', 'safe'],
            [['beginDate','endDate'], JalaliDateToTimestamp::class]
        ];
    }

    public function search($params)
    {
        $query = Source::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'createdAt'
                ],
                'defaultOrder' => [
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'createdBy' => $this->createdBy,
            'mainReasonId' => $this->mainReasonId,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'englishTitle', $this->englishTitle]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        $query->andFilterWhere(['>=', 'createdAt', $this->beginDate]);

        $query->andFilterWhere(['<=', 'createdAt', $this->endDate]);

        $query->hasAnyTags($this->tags);

        $query->andFilterWhere(['like', 'reason', $this->reason]);

        $query->andFilterWhere(['like', 'necessity', $this->necessity]);

        return $dataProvider;
    }
}
