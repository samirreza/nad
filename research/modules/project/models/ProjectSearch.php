<?php

namespace nad\research\modules\project\models;

use yii\data\ActiveDataProvider;

class ProjectSearch extends Project
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title']);
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode', 'category.title'], 'string'],
            [['createdBy', 'status', 'proposalId'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Project::find();
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
            'status' => $this->status,
            'proposalId' => $this->proposalId
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        $query->joinWith('category AS category');
        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );

        return $dataProvider;
    }
}
