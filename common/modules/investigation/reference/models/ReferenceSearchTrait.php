<?php

namespace nad\common\modules\investigation\reference\models;

use yii\data\ActiveDataProvider;

trait ReferenceSearchTrait
{
    public $tag;

    public function rules()
    {
        return [
            [['title', 'type', 'uniqueCode', 'tag'], 'string']
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

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['type' => $this->type])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_reference.id',
                $this->getModelIdsHaveExactTags($this->tag)
            ]);
        }

        return $dataProvider;
    }
}
