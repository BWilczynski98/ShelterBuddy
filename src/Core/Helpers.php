<?php

namespace Core;

class Helpers
{
    public static function dd(...$vals)
    {
        foreach ($vals as $val) {
            echo "<pre>";
            var_dump($val);
            echo "</pre>";
        }
        die();
    }
}