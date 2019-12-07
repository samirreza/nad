<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DeviceDocumentSearchTrait
{
    public function rules()
    {
        return [
            [['title', 'format', 'uniqueCode', 'deviceId'], 'safe'],
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

        $query->andFilterWhere(['=', 'deviceId', $this->deviceId]);
        $query->andFilterWhere(['=', 'format', $this->format]);
        $query->andFilterWhere(['=', 'title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        return $dataProvider;
    }
}
