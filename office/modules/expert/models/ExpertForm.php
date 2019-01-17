<?php

namespace nad\office\modules\expert\models;

use modules\user\backend\models\User;

class ExpertForm extends \yii\base\Model
{
    public $user;
    public $expert;
    public $name;
    public $surname;

    public function __construct($expert, $config = [])
    {
        $this->expert = $expert;
        parent::__construct($config);
    }

    public function init()
    {
        if ($this->expert->isNewRecord) {
            $this->user = new User([
                'status' => User::STATUS_ACTIVE
            ]);
        } else {
            $this->user = $this->expert->user;
            $this->name = $this->user->name;
            $this->surname = $this->user->surname;
        }
        parent::init();
    }

    public function rules()
    {
        return [
            [['name', 'surname'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => $this->user->getAttributeLabel('name'),
            'surname' => $this->user->getAttributeLabel('surname')
        ];
    }

    public function load($data, $formName = null)
    {
        parent::load($data, $formName);
        $this->user->name = $this->name;
        $this->user->surname = $this->surname;
        return $this->user->load($data, $formName) &&
            $this->expert->load($data, $formName);
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (!parent::validate($attributeNames, $clearErrors)) {
            return false;
        }
        foreach (['expert', 'user'] as $model) {
            if (!$this->$model->validate()) {
                $this->addErrors($this->$model->getErrors());
            }
        }
        return !$this->hasErrors();
    }

    public function getErrors($attribute = null)
    {
        $errors = [];
        foreach (['expert', 'user'] as $model) {
            if (!empty($this->$model->getErrors())) {
                $errors = array_merge($this->$model->getErrors(), $errors);
            }
        }
        return $errors;
    }

    public function save()
    {
        if ($this->validate() && $this->saveUser()) {
            $this->expert->userId = $this->user->id;
            if ($this->expert->save()) {
                return true;
            }
        }
        return false;
    }

    public function saveUser()
    {
        if (
            $this->user !== null &&
            !empty($this->user->getDirtyAttributes())
        ) {
            return $this->user->save();
        }
        return true;
    }
}
