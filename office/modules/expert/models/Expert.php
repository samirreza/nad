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
            ['departmentId', 'required']
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

    public function getName()
    {
        return $this->user->name;
    }

    public function getSurname()
    {
        return $this->user->surname;
    }

    public function getUserId()
    {
        return $this->user->id;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->assignDepartmentExpertRole();
        }
        if ($this->getOldAttribute('departmentId') != $this->departmentId) {
            $this->revokePreviousDepartmentExpertRole();
            $this->assignDepartmentExpertRole();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->user->delete();
        parent::afterDelete();
    }

    public function getDepartmentExpertRole()
    {
        return self::getDepartmentExpertRoles()[$this->departmentId];
    }

    public static function tableName()
    {
        return 'nad_office_expert';
    }

    public static function getDepartmentExpertRoles()
    {
        return [
            self::DEPARTMENT_RESEARCH => 'research.expert'
        ];
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

    private function assignDepartmentExpertRole()
    {
        $authManager = Yii::$app->authManager;
        $authManager->assign(
            $authManager->getRole($this->departmentExpertRole),
            $this->userId
        );
    }

    private function revokePreviousDepartmentExpertRole()
    {
        $authManager = Yii::$app->authManager;
        $authManager->revoke(
            $authManager->getRole(
                self::getDepartmentExpertRoles()[$this->getOldAttribute('departmentId')]
            ),
            $this->userId
        );
    }
}
