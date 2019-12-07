<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DeviceInstanceSearchTrait
{

    public function rules()
    {
        return [
            [['deviceId', 'code', 'uniqueCode'], 'safe'],
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

        $query->joinWith('device');
        $query->andFilterWhere(['=', 'deviceId', $this->deviceId]);
        $query->andFilterWhere(['like', 'nad_eng_device_instance.code', $this->code]);
        $query->andFilterWhere(['like', 'nad_eng_device_instance.uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
