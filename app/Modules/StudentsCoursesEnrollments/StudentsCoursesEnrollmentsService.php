<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use Illuminate\Support\Facades\Auth;

class StudentsCoursesEnrollmentsService
{
    private StudentsCoursesEnrollmentsValidator $validator;
    private StudentsCoursesEnrollmentsRepository $repository;

    public function __construct(
        StudentsCoursesEnrollmentsValidator $validator,
        StudentsCoursesEnrollmentsRepository $repository
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id): StudentsCoursesEnrollments
    {
        return $this->repository->get($id);
    }

    public function update(array $data) : StudentsCoursesEnrollments
    {
        $data = array_merge(
            $data,
            [
                "enrolledByUsersId" => Auth::user()->id
            ]
        );
        $this->validator->validateUpdate($data);
        return $this->repository->update(
            StudentsCoursesEnrollmentsMapper::mapFrom($data)
        );
    }

    public function softDelete(int $id): bool
    {
        return $this->repository->softDelete($id);
    }

}
