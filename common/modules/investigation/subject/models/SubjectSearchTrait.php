<?php

namespace nad\common\modules\investigation\subject\models;

use yii\data\ActiveDataProvider;
use yii\db\Query;

trait SubjectSearchTrait
{
    public $tag;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title', 'tag', 'expert.userId']);
    }

    public function rules()
    {
        return [
            [['title', 'uniqueCode', 'category.title', 'tag', 'expert.userId'], 'string'],
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
            'createdBy' => $this->createdBy
        ])
            ->andFilterWhere(['like', 'nad_investigation_subject.title', $this->title])
            ->andFilterWhere(['like', 'nad_investigation_subject.uniqueCode', $this->uniqueCode])
            ->andFilterWhere(['like', 'nad_investigation_subject.isArchived', $this->isArchived])
            ->andFilterWhere(['like', 'nad_investigation_subject.status', $this->status]);

        if (!empty($this->tag)) {
            $query->andWhere([
                'in',
                'nad_investigation_subject.id',
                $this->getModelIdsHaveExactTags($this->tag)
            ]);
        }

        $query->joinWith('category AS category')
            ->andFilterWhere(
                ['like', 'category.title', $this->getAttribute('category.title')]
            );

        $query->joinWith('expert AS expert');
        $query->andFilterWhere(
            ['=', 'expert.userId', $this->getAttribute('expert.userId')]
        );

        // OMG
        // $otherreportCountSubQuery = (new Query())->select('subjectId')->from('nad_investigation_otherreport')->groupBy(['subjectId']);

        // $expertExistSubQuery = (new Query())->select('*')->from('nad_investigation_subject_expert_relation exp')->where('nad_investigation_subject.id = exp.subjectId');

        // if($this->status == SubjectCommon::STATUS_IN_NEXT_STEP_ONE_PROPOSAL){
        //     $query->andFilterWhere([
        //             'status' => SubjectCommon::STATUS_IN_NEXT_STEP
        //             ])->andWhere([
        //                 'not in', 'nad_investigation_subject.id', $otherreportCountSubQuery
        //             ]);
        // }elseif($this->status == SubjectCommon::STATUS_IN_NEXT_STEP_MORE_PROPOSALS){
        //     $query->andFilterWhere([
        //         'status' => SubjectCommon::STATUS_IN_NEXT_STEP
        //         ])->andWhere([
        //             'in', 'nad_investigation_subject.id', $otherreportCountSubQuery->having('count(*) > 0')
        //         ]);
        // }elseif($this->status == SubjectCommon::STATUS_WAITING_FOR_SEND_TO_WRITE_PROPOSAL){
        //     $query->andFilterWhere([
        //             'status' => SubjectCommon::STATUS_ACCEPTED
        //         ])->andFilterWhere(
        //             ['exists',  $expertExistSubQuery]
        //         );
        // }else{
        //     if($this->status == SubjectCommon::STATUS_ACCEPTED){
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
