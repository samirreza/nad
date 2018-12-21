<?php

namespace nad\common\code;

trait CodableTrait
{
    public function getHtmlCodedTitle() : string
    {
        return '<span style="display: inline-block">' . $this->title . '</span><small> ['
            . $this->getUniqueCode() . '] </small>';
    }

    public function getCodedTitle() : string
    {
        return $this->title . ' - ' . $this->getUniqueCode();
    }
}
