<?php

namespace nad\common\modules\investigation\report\models;

use yii\data\ActiveDataProvider;

trait ReportSearchTrait
{
    public $tag;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title', 'tag']);
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode', 'category.title', 'tag'], 'string'],
            [['createdBy', 'status', 'proposalId'], 'integer']
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
            ->andFilterWhere(['like', 'nad_investigation_report.title', $this->title])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode])
            ->andFilterWhere(['like', 'isArchived', $this->isArchived]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_report.id',
                $this->getModelIdsHaveExactTags($this->tag)
            ]);
        }

        $query->joinWith('category AS category')
            ->andFilterWhere(
                ['like', 'category.title', $this->getAttribute('category.title')]
            );

        return $dataProvider;
    }
}
