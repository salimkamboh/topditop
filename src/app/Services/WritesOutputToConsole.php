<?php

namespace App\Services;

trait WritesOutputToConsole
{
    private function output(string $message)
    {
        print_r($message . PHP_EOL);
    }
}