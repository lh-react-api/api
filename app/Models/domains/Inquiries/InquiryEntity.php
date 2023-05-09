<?php

namespace App\Models\domains\Inquiries;

use App\Enums\Inquiries\InquiriesStatus;
use App\Models\domains\BaseDomain;

class InquiryEntity extends BaseDomain
{
    public function __construct(
        protected int $inquiryTypeId,
        protected string $email,
        protected string $text,
        protected InquiriesStatus $status,
    ) {
    }

    public function getInquiryTypeId(): int
    {
        return $this->inquiryTypeId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getStatus(): InquiriesStatus
    {
        return $this->status;
    }
}