<?php

namespace App\Models;

use App\Enums\Inquiries\InquiriesStatus;
use App\Models\domains\Inquiries\InquiryEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'inquiry_type_id',
        'email',
        'text',
        'status',
    ];


    public static function create(InquiryEntity $inquiry): Inquiry
    {

        $entity = (new Inquiry)->fill([
            'inquiry_type_id' => $inquiry->getInquiryTypeId(),
            'email' => $inquiry->getEmail(),
            'text' => $inquiry->getText(),
            'status' => $inquiry->getStatus()
        ]);

        $entity->save();

        return $entity;
    }

}
