<?php

namespace nad\common\code;

interface Codable
{
    public function getUniqueCode() : string;

    public function getCodedTitle() : string;

    public function getHtmlCodedTitle() : string;
}
