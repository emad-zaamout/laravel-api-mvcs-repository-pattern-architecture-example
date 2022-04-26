<?php

declare(strict_types=1);

namespace App\Modules\Students;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class StudentsRepository
{
    private $tableName = "students";
    private $selectColumns = [
        "students.id",
        "students.name",
        "students.email",
        "students.deleted_at AS deletedAt",
        "students.created_at AS createdAt",
        "students.updated_at AS updatedAt"
    ];

    public function get(int $id) : Students
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
            throw new InvalidArgumentException("Invalid student id.");
        }

        return StudentsMapper::mapFrom($result);
    }

    public function update(Students $student): Students
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
            throw new InvalidArgumentException("Invalid Students Id.");
        }

        return true;
    }

    public function getByCourseId(int $courseId): array
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $result = json_decode(json_encode(
            DB::select("SELECT $selectColumns
                FROM students
                JOIN students_courses_enrollments ON students_courses_enrollments.courses_id = :courseId
                WHERE students.id = students_courses_enrollments.students_id
                AND students_courses_enrollments.deleted_at IS NULL
            ", [
                "courseId" => $courseId
            ])
        ), true);

        if (count($result) === 0) {
           return [];
        }

        return array_map(function ($row) {
            return StudentsMapper::mapFrom($row);
        }, $result);
    }
}
