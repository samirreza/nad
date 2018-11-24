<?php

namespace nad\research\modules\expert\models;

use Yii;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use core\behaviors\PreventDeleteBehavior;
use nad\research\modules\proposal\models\Proposal;
use nad\research\modules\project\models\Project;

class Expert extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getProposals',
                        'relationName' => 'پروپوزال'
                    ],
                    [
                        'relationMethod' => 'getProjects',
                        'relationName' => 'پروژه'
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            ['userId', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'userId' => 'کاربر',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }

    public function getEmail()
    {
        return $this->user->email;
    }

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id'])
            ->viaTable('nad_research_source', ['expertId' => 'id']);
    }

    public function getProjects()
    {
        return $this->hasMany(Project::class, ['proposalId' => 'id'])
            ->viaTable('nad_research_proposal', ['expertId' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            if ($this->hasExpertRole()) {
                $this->addError(
                    'userId',
                    'این کاربر در حال حاضر کارشناس است.'
                );
                return false;
            }
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->assignExpertRole();
        parent::afterSave($insert, $changedAttributes);
    }

    public static function tableName()
    {
        return 'nad_research_expert';
    }

    private function hasExpertRole()
    {
        return Yii::$app->authManager->checkAccess($this->userId, 'expert');
    }

    private function assignExpertRole()
    {
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole('expert'), $this->userId);
    }
}
