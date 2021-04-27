<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileHandler
{
    /**
     * Store media to storage
     *
     * @param string $mediaName
     * @param string $disk
     * @return void
     */
    protected function uploadMedia($inputName, $prefix = '', $storagePath = ''): String
    {
        $name = $prefix . '_' . time() . '_' . random_int(100, 999) . '.' . $inputName->getClientOriginalExtension();
        $inputName->move(storage_path('app/public/' . $storagePath), $name);
        return $name;
    }

    /**
     * Remove media from storage
     *
     * @param string $mediaName
     * @param string $disk
     * @return void
     */
    protected function deleteMedia($mediaName = '', $disk = '')
    {
        $storage = Storage::disk($disk);
        return $storage->delete($mediaName);
    }
}