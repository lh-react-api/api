<?php

namespace App\Models\domains\Notices   ;

use App\Models\domains\BaseDomain;

class NoticeEntity extends BaseDomain
{
    public function __construct(
        protected string $division,
        protected string $title,
        protected string $text,
        protected string $noticeDate,
        protected string $closeDate,
    ) {
    }

    public function getDivision(): string
    {
        return $this->division;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getNoticeDate(): string
    {
        return $this->noticeDate;
    }

    public function getCloseDate(): string
    {
        return $this->closeDate;
    }
}