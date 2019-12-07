<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DevicePartDocumentSearchTrait
{
    public function rules()
    {
        return [
            [['title', 'code', 'uniqueCode', 'partId'], 'safe'],
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

        $query->andFilterWhere(['=', 'partId', $this->partId]);
        $query->andFilterWhere(['=', 'code', $this->code]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        return $dataProvider;
    }
}
