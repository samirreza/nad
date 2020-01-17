<?php

namespace nad\common\modules\investigation\otherreport\models;

use yii\data\ActiveDataProvider;

trait OtherreportSearchTrait
{
    public $tag;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['tag']);
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode', 'tag'], 'string'],
            [['createdBy', 'status', 'subjectId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = parent::find();
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
            'createdBy' => $this->createdBy,
            'status' => $this->status
        ])
            ->andFilterWhere(['like', 'nad_investigation_otherreport.title', $this->title])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode])
            ->andFilterWhere(['like', 'isArchived', $this->isArchived]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_otherreport.id',
                $this->getModelIdsHaveExactTags($this->tag)
            ]);
        }

        return $dataProvider;
    }
}
