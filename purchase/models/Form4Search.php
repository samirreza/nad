<?php

namespace nad\purchase\models;

use yii\data\ActiveDataProvider;

/**
 * Form4Search represents the model behind the search form of `nad\purchase\models\Form4`.
 */
class Form4Search extends Form4
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'createdBy', 'updatedBy', 'createdAt', 'updatedAt'], 'integer'],
            [['title', 'productName', 'factorNumber'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Form4::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'productName', $this->productName])
            ->andFilterWhere(['like', 'factorNumber', $this->factorNumber]);

        return $dataProvider;
    }
}
