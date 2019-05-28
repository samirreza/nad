<?php

namespace nad\office\modules\expert\models;

use Yii;
use yii\db\ActiveRecord;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use extensions\file\behaviors\FileBehavior;

class Expert extends ActiveRecord
{
    const DEPARTMENT_PROCESS = 0;

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
                            'maxSize' => 10 * 1024 * 1024
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

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->assignDepartmentRoles();
        }
        if ($this->getOldAttribute('departmentId') != $this->departmentId) {
            $this->revokePreviousDepartmentRoles();
            $this->assignDepartmentRoles();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->user->delete();
        parent::afterDelete();
    }

    public static function tableName()
    {
        return 'nad_office_expert';
    }

    public static function getDepartmentRoles()
    {
        return [
            self::DEPARTMENT_PROCESS => [
                'expert'
            ]
        ];
    }

    public static function getDepartmentLabels()
    {
        return [
            self::DEPARTMENT_PROCESS => 'فرایند'
        ];
    }

    public static function getDepartmentExperts($departmentId)
    {
        return self::find()
            ->andWhere(['departmentId' => $departmentId])
            ->all();
    }

    public static function getDepartmentExpertsByPermission($departmentId, $permission)
    {
        $experts = [];
        $authManager = Yii::$app->authManager;
        foreach (self::getDepartmentExperts($departmentId) as $expert) {
            if ($authManager->checkAccess($expert->userId, $permission)) {
                $experts[] = $expert;
            }
        }

        return $experts;
    }

    private function assignDepartmentRoles()
    {
        $authManager = Yii::$app->authManager;
        $roles = self::getDepartmentRoles()[$this->departmentId];
        foreach ($roles as $role) {
            if (!$authManager->checkAccess($this->userId, $role)) {
                $authManager->assign(
                    $authManager->getRole($role),
                    $this->userId
                );
            }
        }
    }

    private function revokePreviousDepartmentRoles()
    {
        $authManager = Yii::$app->authManager;
        $roles = self::getDepartmentRoles()[$this->getOldAttribute('departmentId')];
        foreach ($roles as $role) {
            if ($authManager->checkAccess($this->userId, $role)) {
                $authManager->revoke(
                    $authManager->getRole($role),
                    $this->userId
                );
            }
        }
    }
}
