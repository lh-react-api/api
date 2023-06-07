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
        // 管理側はステータスも自由に登録させるためstringも許容
        // バリデーションでENUMはチェックする
        protected InquiriesStatus|string $status, 
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

    public function getStatus(): InquiriesStatus|string
    {
        return $this->status;
    }
}