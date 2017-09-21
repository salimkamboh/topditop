<?php

namespace App\Services;

trait WritesOutputToConsole
{
    public $outputEnabled = false;

    private function output(string $message)
    {
        if ($this->outputEnabled) {
            print_r($message . PHP_EOL);
        }
    }
}