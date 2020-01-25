<?php

namespace nad\common\modules\investigation\subject\models;

use yii\data\ActiveDataProvider;
use yii\db\Query;

trait SubjectSearchTrait
{
    public $tag;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['tag', 'expert.userId']);
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode', 'tag', 'expert.userId'], 'string'],
            [['createdBy', 'status'], 'integer']
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
            'createdBy' => $this->createdBy
        ])
            ->andFilterWhere(['like', 'nad_investigation_subject.title', $this->title])
            ->andFilterWhere(['like', 'nad_investigation_subject.uniqueCode', $this->uniqueCode])
            ->andFilterWhere(['like', 'nad_investigation_subject.isArchived', $this->isArchived])
            ->andFilterWhere(['like', 'nad_investigation_subject.status', $this->status]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_subject.id',
                $this->getModelIdsHaveExactTags($this->tag)
            ]);
        }

        $query->joinWith('expert AS expert');
        $query->andFilterWhere(
            ['=', 'expert.userId', $this->getAttribute('expert.userId')]
        );

        return $dataProvider;
    }
}
