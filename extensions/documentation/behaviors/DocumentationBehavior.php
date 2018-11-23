<?php

namespace nad\extensions\documentation\behaviors;

use yii;
use yii\db\ActiveRecord;
use nad\extensions\documentation\models\Documentation;

class DocumentationBehavior extends \yii\base\Behavior
{
    public $documentationIdAttribute = 'documentationId';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteDocumentationAfterDeletion'
        ];
    }

    public function createDocumentation()
    {
        if ($this->hasDocumentation()) {
            return $this->getDocumentation();
        }

        $documentation = new Documentation([
            'modelClassName' => (new \ReflectionClass($this->owner))->name
        ]);
        $documentation->save();
        $this->owner->{$this->documentationIdAttribute} = $documentation->id;
        $this->owner->save(false);
        return $documentation;
    }

    public function deleteDocumentation()
    {
        $documentation = $this->getDocumentation();
        if ($documentation) {
            $documentation->delete();
        }
        $this->owner->{$this->documentationIdAttribute} = null;
        $this->owner->save(false);
    }

    public function hasDocumentation()
    {
        return empty($this->getDocumentation()) ? false : true;
    }

    public function getDocumentation()
    {
        return Documentation::findOne(
            $this->owner->{$this->documentationIdAttribute}
        );
    }

    public function getDocumentationFiles()
    {
        if (!$this->hasDocumentation()) {
            return [];
        }
        return $this->getDocumentation()->files;
    }

    public function deleteDocumentationAfterDeletion()
    {
        !$this->hasDocumentation() ? : $this->getDocumentation()->delete();
    }
}
