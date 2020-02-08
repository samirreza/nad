<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DocumentGroupDocumentSearchTrait
{
    public function rules()
    {
        return [
            [['groupId', 'title', 'uniqueCode'], 'safe'],
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

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(['groupId' => $this->groupId]);
        return $dataProvider;
    }
}
