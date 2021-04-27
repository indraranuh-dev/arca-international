<?php

namespace App\Constants;

class InvoiceStatus
{
    const SUCCESS = 'Success',
    PENDING = 'Pending',
    FAILED = 'Failed';

    public function getAll()
    {
        return [
            [
                'name' => SELF::SUCCESS,
                'slug_name' => slug(SELF::SUCCESS),
            ],
            [
                'name' => SELF::PENDING,
                'slug_name' => slug(SELF::PENDING),
            ],
            [
                'name' => SELF::FAILED,
                'slug_name' => slug(SELF::FAILED),
            ],
        ];
    }

}