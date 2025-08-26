<?php

namespace App\Http\Controllers;

use App\Models\CourseResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseResourceController extends Controller
{
    /**
     * عرض ملحقات الدورة
     */
    public function index(Course $course)
    {
        $resources = $course->resources()
            ->published()
            ->ordered()
            ->get();

        return view('course-resources.index', compact('course', 'resources'));
    }

    /**
     * عرض ملحقات درس معين
     */
    public function lessonResources(Lesson $lesson)
    {
        $resources = $lesson->resources()
            ->published()
            ->ordered()
            ->get();

        return view('course-resources.lesson', compact('lesson', 'resources'));
    }

    /**
     * تحميل ملف
     */
    public function download(CourseResource $resource)
    {
        // التحقق من الصلاحية
        if (!$resource->is_free && !Auth::user()->enrolledCourses()->where('course_id', $resource->course_id)->exists()) {
            abort(403, 'يجب التسجيل في الدورة لتحميل هذا الملف');
        }

        if ($resource->external_url) {
            return redirect($resource->external_url);
        }

        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            $resource->incrementDownloadCount();
            return Storage::disk('public')->download($resource->file_path, $resource->file_name);
        }

        abort(404, 'الملف غير موجود');
    }

    /**
     * عرض معلومات الملف
     */
    public function show(CourseResource $resource)
    {
        return view('course-resources.show', compact('resource'));
    }

    /**
     * إنشاء ملحق جديد (للمعلمين)
     */
    public function create(Course $course)
    {
        $this->authorize('create', [CourseResource::class, $course]);
        
        $lessons = $course->lessons;
        return view('course-resources.create', compact('course', 'lessons'));
    }

    /**
     * حفظ ملحق جديد
     */
    public function store(Request $request, Course $course)
    {
        $this->authorize('create', [CourseResource::class, $course]);

        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'type' => 'required|in:pdf,video,link,document,image,audio',
            'lesson_id' => 'nullable|exists:lessons,id',
            'file' => 'nullable|file|max:10240', // 10MB max
            'external_url' => 'nullable|url',
            'is_free' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'title_ar', 'title_en', 'description_ar', 'description_en',
            'type', 'lesson_id', 'external_url', 'is_free', 'is_published', 'sort_order'
        ]);

        $data['course_id'] = $course->id;
        $data['is_free'] = $request->has('is_free');
        $data['is_published'] = $request->has('is_published');

        // رفع الملف إذا وجد
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('course-resources', 'public');
            
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        CourseResource::create($data);

        return redirect()->route('courses.resources.index', $course)
            ->with('success', 'تم إضافة الملحق بنجاح');
    }

    /**
     * تعديل ملحق
     */
    public function edit(CourseResource $resource)
    {
        $this->authorize('update', $resource);
        
        $course = $resource->course;
        $lessons = $course->lessons;
        
        return view('course-resources.edit', compact('resource', 'course', 'lessons'));
    }

    /**
     * تحديث ملحق
     */
    public function update(Request $request, CourseResource $resource)
    {
        $this->authorize('update', $resource);

        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'type' => 'required|in:pdf,video,link,document,image,audio',
            'lesson_id' => 'nullable|exists:lessons,id',
            'file' => 'nullable|file|max:10240',
            'external_url' => 'nullable|url',
            'is_free' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'title_ar', 'title_en', 'description_ar', 'description_en',
            'type', 'lesson_id', 'external_url', 'is_free', 'is_published', 'sort_order'
        ]);

        $data['is_free'] = $request->has('is_free');
        $data['is_published'] = $request->has('is_published');

        // رفع ملف جديد إذا وجد
        if ($request->hasFile('file')) {
            // حذف الملف القديم
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('course-resources', 'public');
            
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        $resource->update($data);

        return redirect()->route('courses.resources.index', $resource->course)
            ->with('success', 'تم تحديث الملحق بنجاح');
    }

    /**
     * حذف ملحق
     */
    public function destroy(CourseResource $resource)
    {
        $this->authorize('delete', $resource);

        // حذف الملف من التخزين
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()->back()->with('success', 'تم حذف الملحق بنجاح');
    }

    /**
     * البحث في الملحقات
     */
    public function search(Request $request, Course $course)
    {
        $query = $request->get('q');
        $type = $request->get('type');

        $resources = $course->resources()
            ->published()
            ->when($query, function($q) use ($query) {
                $q->where(function($subQ) use ($query) {
                    $subQ->where('title_ar', 'like', "%{$query}%")
                         ->orWhere('title_en', 'like', "%{$query}%")
                         ->orWhere('description_ar', 'like', "%{$query}%")
                         ->orWhere('description_en', 'like', "%{$query}%");
                });
            })
            ->when($type, function($q) use ($type) {
                $q->where('type', $type);
            })
            ->ordered()
            ->paginate(12);

        return view('course-resources.search', compact('course', 'resources', 'query', 'type'));
    }
}
