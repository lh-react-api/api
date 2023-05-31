<?php

namespace App\Models\domains\InquiryTypes;

use App\Models\domains\BaseDomain;

class InquiryTypeEntity extends BaseDomain
{
    public function __construct(
        protected string      $text,
    )
    {
    }

    public function getText(): string
    {
        return $this->text;
    }
}