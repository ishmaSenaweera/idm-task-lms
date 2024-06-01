<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * All users can view courses.
     */
    public function view(User $user)
    {
        return in_array($user->role, ['Admin', 'Teacher', 'Academic Head', 'Student']);
    }

    /**
     * Only admin or academic head can create a course.
     */
    public function create(User $user)
    {
        return in_array($user->role, ['Admin', 'Academic Head']);
    }

    /**
     * Admin can update a course and academic head can update in draft mode / if he published a course within 6 hours from published time.
     */
    public function update(User $user, Course $course)
    {
        if ($user->role === 'Admin') {
            return true;
        }

        if ($user->role === 'Academic Head') {
            // Allow update if course is in draft or within 6 hours of publishing
            return $course->status === 'draft' || ($course->status === 'publish' && $course->published_at->diffInHours(Carbon::now()) <= 6);
        }

        return false;
    }

    /**
     * Admin can delete a course and academic head can delete in draft mode / if he published a course within 6 hours from published time.
     */
    public function delete(User $user, Course $course): bool
    {
        if ($user->role === 'Admin') {
            return true;
        }

        if ($user->role === 'Academic Head') {
            // Allow delete if course is in draft or within 6 hours of publishing
            return $course->status === 'draft' || ($course->status === 'publish' && $course->published_at->diffInHours(Carbon::now()) <= 6);
        }

        return false;
    }
}
