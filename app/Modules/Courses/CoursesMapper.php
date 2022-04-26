<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use App\Modules\Common\MyHelpers;

class CoursesMapper
{
    public static function mapFrom(array $data): Courses
    {
        return new Courses(
            MyHelpers::nullStringToInt($data["id"] ?? null),
            $data["name"],
            $data["capacity"],
            $data["totalStudentsEnrolled"] ?? 0,
            $data["deletedAt"] ?? null,
            $data["createdAt"] ?? date("Y-m-d H:i:s"),
            $data["updatedAt"] ?? null,

        );
    }
}
