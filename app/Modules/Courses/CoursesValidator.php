<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use InvalidArgumentException;

class CoursesValidator
{

    public function validateUpdate(array $data): void
    {
        $validator = validator($data, [
            "name" => "required|string",
            "capacity" => "required|integer",
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException(json_encode($validator->errors()->all()));
        }
    }

}
