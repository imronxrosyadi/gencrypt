<?php

namespace App\Helpers;

class CommonHelper 
{
    public static function formatSize($size)
    {
        if ($size >= 1_000_000) {
            return round($size / 1_000_000, 2) . ' MB';
        } elseif ($size >= 1000) {
            return round($size / 1000, 2) . ' KB';
        } else {
            return $size . ' bytes';
        }
    }
}
