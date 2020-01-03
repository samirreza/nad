<?php

namespace nad\common\modules\investigation\proposal\models;

use yii\data\ActiveDataProvider;

trait ProposalSearchTrait
{
    public $tag;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title', 'tag']);
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode', 'category.title', 'tag'], 'string'],
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
            'createdBy' => $this->createdBy,
            'status' => $this->status
        ])
            ->andFilterWhere(['like', 'nad_investigation_proposal.title', $this->title])
            ->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode])
            ->andFilterWhere(['like', 'isArchived', $this->isArchived]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_proposal.id',
                $this->getModelIdsHaveExactTags($this->tag)
            ]);
        }

        $query->joinWith('category AS category')
            ->andFilterWhere(
                ['like', 'category.title', $this->getAttribute('category.title')]
            );

        // OMG
        // $proposalCountSubQuery = (new Query())->select('sourceId')->from('nad_investigation_proposal')->groupBy(['sourceId']);

        // $expertExistSubQuery = (new Query())->select('*')->from('nad_investigation_source_expert_relation exp')->where('nad_investigation_source.id = exp.sourceId');

        // if($this->status == SourceCommon::STATUS_IN_NEXT_STEP_ONE_PROPOSAL){
        //     $query->andFilterWhere([
        //             'status' => SourceCommon::STATUS_IN_NEXT_STEP
        //             ])->andWhere([
        //                 'not in', 'nad_investigation_source.id', $proposalCountSubQuery
        //             ]);
        // }elseif($this->status == SourceCommon::STATUS_IN_NEXT_STEP_MORE_PROPOSALS){
        //     $query->andFilterWhere([
        //         'status' => SourceCommon::STATUS_IN_NEXT_STEP
        //         ])->andWhere([
        //             'in', 'nad_investigation_source.id', $proposalCountSubQuery->having('count(*) > 0')
        //         ]);
        // }elseif($this->status == SourceCommon::STATUS_WAITING_FOR_SEND_TO_WRITE_PROPOSAL){
        //     $query->andFilterWhere([
        //             'status' => SourceCommon::STATUS_ACCEPTED
        //         ])->andFilterWhere(
        //             ['exists',  $expertExistSubQuery]
        //         );
        // }else{
        //     if($this->status == SourceCommon::STATUS_ACCEPTED){
        //         $query->andFilterWhere(
        //             ['not exists',  $expertExistSubQuery]
        //         );
        //     }

        //     $query->andFilterWhere([
        //         'status' => $this->status
        //     ]);
        // }
        // end of OMG

        return $dataProvider;
    }
}
