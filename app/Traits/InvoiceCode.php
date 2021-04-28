<?php

namespace App\Traits;

trait InvoiceCode
{
    /**
     * Prefix and string collection
     *
     * @var string
     */
    public $invoicePrevix = 'INV/',
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    /**
     * Generate unique invoice code
     *
     * @return void
     */
    public function generateInvoiceCode()
    {
        return $this->invoicePrevix . date('dmYHis/') . $this->generateRandomString();
    }

    /**
     * Generate random string from string collecion above
     *
     * @param integer $length
     * @return void
     */
    public function generateRandomString($length = 5)
    {
        return substr(
            str_shuffle(
                str_repeat($this->string, ceil($length / strlen($this->string)))
            ), 1, $length
        );
    }
}