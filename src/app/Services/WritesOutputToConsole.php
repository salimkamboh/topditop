<?php

namespace App\Services;

trait WritesOutputToConsole
{
    protected $outputEnabled = false;

    private function output(string $message)
    {
        if ($this->outputEnabled) {
            print_r($message . PHP_EOL);
        }
    }
}