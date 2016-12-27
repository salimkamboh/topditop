<?php

namespace App\Helpers\Contracts;

use App\Field;
use App\Profile;

Interface HtmlConvertContract
{
    public function detectFieldType(Field $field);

    public function htmlHelper(Field $field, Profile $profile);

}