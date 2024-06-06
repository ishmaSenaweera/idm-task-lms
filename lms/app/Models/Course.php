<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'seo_url',
        'faculty',
        'category',
        'status',
        'published_at'
    ];

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class, 'course_id');
    }

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class, 'course_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_courses', 'course_id', 'user_id')
            ->withPivot('enrollment_year')
            ->withTimestamps();
    }
}
