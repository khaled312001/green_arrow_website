<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * عرض صندوق الوارد
     */
    public function inbox()
    {
        $user = Auth::user();
        $messages = $user->receivedMessages()
            ->with(['sender', 'course'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('messages.inbox', compact('messages'));
    }

    /**
     * عرض الرسائل المرسلة
     */
    public function sent()
    {
        $user = Auth::user();
        $messages = $user->sentMessages()
            ->with(['receiver', 'course'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('messages.sent', compact('messages'));
    }

    /**
     * عرض نموذج إنشاء رسالة جديدة
     */
    public function create(Request $request)
    {
        $courses = Course::where('instructor_id', Auth::id())->get();
        $students = User::role('student')->get();
        $teachers = User::role('teacher')->get();
        $admins = User::role('admin')->get();

        $selectedCourse = $request->get('course_id');
        $selectedReceiver = $request->get('receiver_id');

        return view('messages.create', compact('courses', 'students', 'teachers', 'admins', 'selectedCourse', 'selectedReceiver'));
    }

    /**
     * حفظ رسالة جديدة
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
            'type' => 'required|in:general,course_question,technical_support,feedback',
            'priority' => 'required|in:low,medium,high,urgent',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'course_id' => $request->course_id,
            'subject' => $request->subject,
            'content' => $request->content,
            'type' => $request->type,
            'priority' => $request->priority,
        ]);

        return redirect()->route('messages.inbox')
            ->with('success', 'تم إرسال الرسالة بنجاح');
    }

    /**
     * عرض رسالة واحدة
     */
    public function show(Message $message)
    {
        $user = Auth::user();
        
        // التحقق من الصلاحية
        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            abort(403);
        }

        // تحديد الرسالة كمقروءة إذا كان المستلم
        if ($message->receiver_id === $user->id && $message->status === 'unread') {
            $message->markAsRead();
        }

        $replies = $message->replies()->with(['sender', 'receiver'])->orderBy('created_at')->get();

        return view('messages.show', compact('message', 'replies'));
    }

    /**
     * الرد على رسالة
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $user = Auth::user();
        
        // التحقق من الصلاحية
        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            abort(403);
        }

        // تحديد المستلم (الطرف الآخر)
        $receiverId = $message->sender_id === $user->id ? $message->receiver_id : $message->sender_id;

        $reply = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'course_id' => $message->course_id,
            'subject' => 'رد: ' . ($message->subject ?? 'رسالة'),
            'content' => $request->content,
            'type' => $message->type,
            'priority' => $message->priority,
            'parent_id' => $message->id,
        ]);

        // تحديث حالة الرسالة الأصلية
        $message->markAsReplied();

        return redirect()->back()->with('success', 'تم إرسال الرد بنجاح');
    }

    /**
     * حذف رسالة
     */
    public function destroy(Message $message)
    {
        $user = Auth::user();
        
        // التحقق من الصلاحية
        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            abort(403);
        }

        $message->delete();

        return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
    }

    /**
     * تحديث حالة الرسالة
     */
    public function updateStatus(Request $request, Message $message)
    {
        $request->validate([
            'status' => 'required|in:read,replied,closed',
        ]);

        $user = Auth::user();
        
        // التحقق من الصلاحية
        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            abort(403);
        }

        $message->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    /**
     * البحث في الرسائل
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->get('q');
        $type = $request->get('type');
        $status = $request->get('status');

        $messages = $user->messages()
            ->with(['sender', 'receiver', 'course'])
            ->when($query, function($q) use ($query) {
                $q->where(function($subQ) use ($query) {
                    $subQ->where('subject', 'like', "%{$query}%")
                         ->orWhere('content', 'like', "%{$query}%");
                });
            })
            ->when($type, function($q) use ($type) {
                $q->where('type', $type);
            })
            ->when($status, function($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('messages.search', compact('messages', 'query', 'type', 'status'));
    }

    /**
     * إرسال رسالة من صفحة الدورة
     */
    public function sendFromCourse(Request $request, Course $course)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'type' => 'required|in:general,course_question,technical_support,feedback',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $course->instructor_id,
            'course_id' => $course->id,
            'subject' => 'رسالة من دورة: ' . $course->title_ar,
            'content' => $request->content,
            'type' => $request->type,
            'priority' => $request->priority,
        ]);

        return redirect()->back()->with('success', 'تم إرسال الرسالة للمدرب بنجاح');
    }

    /**
     * الحصول على عدد الرسائل غير المقروءة (لـ AJAX)
     */
    public function unreadCount()
    {
        $count = Auth::user()->receivedMessages()->unread()->count();
        return response()->json(['count' => $count]);
    }
}
