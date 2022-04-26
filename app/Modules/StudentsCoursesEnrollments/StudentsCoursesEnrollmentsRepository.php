<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class StudentsCoursesEnrollmentsRepository
{
    private $tableName = "students_courses_enrollments";
    private $selectColumns = [
        "students_courses_enrollments.id",
        "students_courses_enrollments.students_id AS studentsId",
        "students_courses_enrollments.courses_id AS coursesId",
        "students_courses_enrollments.enrolled_by_users_id AS enrolledByUsersId",
        "students_courses_enrollments.deleted_at AS deletedAt",
        "students_courses_enrollments.created_at AS createdAt",
        "students_courses_enrollments.updated_at AS updatedAt"
    ];

    public function get(int $id) : StudentsCoursesEnrollments
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::selectOne("SELECT $selectColumns
                FROM {$this->tableName}
                WHERE id = :id AND deleted_at IS NULL
            ", [
                "id" => $id
            ])
        ), true);

        if ($result === null) {
            throw new InvalidArgumentException("Invalid students courses enrollments id.");
        }

        return StudentsCoursesEnrollmentsMapper::mapFrom($result);
    }

    public function update(StudentsCoursesEnrollments $student): StudentsCoursesEnrollments
    {
        return DB::transaction(function () use ($student) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $student->getId()
            ], $student->toSQL());

            $id = ($student->getId() === null || $student->getId() === 0)
                ? (int)DB::getPdo()->lastInsertId()
                : $student->getId();

            return $this->get($id);
        });
    }

    public function softDelete(int $id): bool
    {
        $result = DB::table($this->tableName)
            ->where("id", $id)
            ->where("deleted_at", null)
            ->update([
                "deleted_at" => date("Y-m-d H:i:s")
            ]);

        if ($result !== 1) {
            throw new InvalidArgumentException("Invalid students courses enrollments Id.");
        }

        return true;
    }
}
