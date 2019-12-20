<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DocNameLookupSearchTrait
{

    public function rules()
    {
        return [
            [['name', 'type', 'extra'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = parent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'lookup.name', $this->name]);
        $query->andFilterWhere(['like', 'lookup.extra', $this->extra]);
        $query->andFilterWhere(['like', 'lookup.type', $this->type, false]);

        return $dataProvider;
    }
}
