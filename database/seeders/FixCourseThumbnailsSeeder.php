<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class FixCourseThumbnailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تنظيف جميع thumbnails لتكون null
        DB::table('courses')->update(['thumbnail' => null]);
        
        // تنظيف جميع banners لتكون null
        DB::table('courses')->update(['banner' => null]);
        
        $this->command->info('تم تنظيف جميع الصور في الدورات');
        
        // عرض عدد الدورات المحدثة
        $count = DB::table('courses')->whereNull('thumbnail')->count();
        $this->command->info("عدد الدورات بدون thumbnail: {$count}");
        
        // عرض عينة من البيانات
        $courses = DB::table('courses')->select('id', 'title_ar', 'thumbnail')->limit(3)->get();
        foreach ($courses as $course) {
            $this->command->info("Course ID: {$course->id} - Title: {$course->title_ar} - Thumbnail: " . ($course->thumbnail ?? 'NULL'));
        }
    }
} 