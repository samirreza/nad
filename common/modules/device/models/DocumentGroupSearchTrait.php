<?php
namespace nad\common\modules\Device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DocumentGroupSearchTrait
{

    public function attributes()
    {
        return array_merge(parent::attributes(), ['device.title', 'device.id']);
    }

    public function rules()
    {
        return [
            [['deviceId', 'code', 'title', 'device.title', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = DocumentGroup::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('device AS device');
        $query->andFilterWhere(['=', 'device.id', $this->deviceId]);
        $query->andFilterWhere(['like', 'nad_eng_device_document_group.title', $this->title]);
        $query->andFilterWhere(['like', 'nad_eng_device_document_group.code', $this->code]);
        $query->andFilterWhere(['like', 'nad_eng_device_document_group.uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
