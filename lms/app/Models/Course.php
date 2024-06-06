<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->seo_url = self::generateUniqueSlug($course->name);
        });

        static::updating(function ($course) {
            $course->seo_url = self::generateUniqueSlug($course->name, $course->id);
        });
    }

    private static function generateUniqueSlug($name, $excludeId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('seo_url', $slug)
            ->when($excludeId, function ($query) use ($excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()
        ) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

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
