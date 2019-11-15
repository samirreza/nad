<?php

namespace nad\common\modules\investigation\source\models;

use yii\data\ActiveDataProvider;

trait SourceSearchTrait
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
            [['createdBy', 'mainReasonId', 'status'], 'integer']
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
            'mainReasonId' => $this->mainReasonId,
            'status' => $this->status
        ])
            ->andFilterWhere(['like', 'nad_investigation_source.title', $this->title])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode])
            ->andFilterWhere(['like', 'isArchived', $this->isArchived]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_source.id',
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
