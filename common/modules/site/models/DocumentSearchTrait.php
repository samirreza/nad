<?php
namespace nad\common\modules\site\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DocumentSearchTrait
{
    public function rules()
    {
        return [
            [['type', 'uniqueCode', 'siteId'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Parent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'siteId', $this->siteId]);
        $query->andFilterWhere(['=', 'type', $this->type]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        return $dataProvider;
    }
}
