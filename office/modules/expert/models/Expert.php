<?php

namespace nad\office\modules\expert\models;

use Yii;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use extensions\file\behaviors\FileBehavior;

class Expert extends \yii\db\ActiveRecord
{
    const DEPARTMENT_RESEARCH = 0;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => FileBehavior::class,
                'groups' => [
                    'evidence' => [
                        'type' => FileBehavior::TYPE_FILE,
                        'rules' => [
                            'extensions' => [
                                'png',
                                'jpg',
                                'jpeg',
                                'pdf',
                                'doc',
                                'docx',
                                'xls',
                                'xlsx',
                                'ppt',
                                'pptx'
                            ],
                            'maxSize' => 10 * 1024 * 1024,
                            'required' => true
                        ]
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['userId', 'departmentId'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'userId' => 'کاربر',
            'departmentId' => 'دپارتمان',
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

    public function getUserId()
    {
        return $this->user->id;
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
                    'این کاربر در حال حاضر کارشناس این دپارتمان است.'
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

    public function afterDelete()
    {
        Yii::$app->authManager->revoke(
            Yii::$app->authManager->getRole($this->departmentExpertPermission),
            $this->userId
        );
        parent::afterDelete();
    }

    public function getDepartmentExpertPermission()
    {
        return self::getDepartmentExpertPermissions()[$this->departmentId];
    }

    public static function tableName()
    {
        return 'nad_office_expert';
    }

    public static function getDepartmentLabels()
    {
        return [
            self::DEPARTMENT_RESEARCH => 'پژوهش'
        ];
    }

    public static function getDepartmentExperts($departmentId)
    {
        return self::find()
            ->andWhere(['departmentId' => $departmentId])
            ->all();
    }

    private function hasExpertRole()
    {
        return Yii::$app->authManager->checkAccess(
            $this->userId,
            $this->departmentExpertPermission
        );
    }

    private function assignExpertRole()
    {
        $auth = Yii::$app->authManager;
        $auth->assign(
            $auth->getRole($this->departmentExpertPermission),
            $this->userId
        );
    }

    private static function getDepartmentExpertPermissions()
    {
        return [
            self::DEPARTMENT_RESEARCH => 'research.expert'
        ];
    }
}
