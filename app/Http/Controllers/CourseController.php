<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_published', true)->latest()->get();
        return view('welcome', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('courses.show', compact('course'));
    }

    public function lesson($course_slug, $lesson_id = null)
    {
        $course = Course::where('slug', $course_slug)->where('is_published', true)->firstOrFail();

        // Access Control: Check if user owns the course
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->courses()->where('courses.id', $course->id)->exists()) {
            return redirect()->route('courses.show', $course->slug)->with('error', 'Debes adquirir este curso para ver las lecciones.');
        }

        $lessons = $course->lessons()->orderBy('order_index')->get();

        if ($lesson_id) {
            $currentLesson = $lessons->where('id', $lesson_id)->firstOrFail();
        } else {
            $currentLesson = $lessons->first();
        }

        // If course has no lessons
        if (!$currentLesson) {
            return redirect()->route('dashboard')->with('error', 'Este curso aún no tiene contenido.');
        }

        // Previous and Next Logic
        $currentIndex = $lessons->search(function ($item) use ($currentLesson) {
            return $item->id === $currentLesson->id;
        });

        $previousLesson = $currentIndex > 0 ? $lessons[$currentIndex - 1] : null;
        $nextLesson = $currentIndex < $lessons->count() - 1 ? $lessons[$currentIndex + 1] : null;

        return view('lessons.show', compact('course', 'currentLesson', 'lessons', 'previousLesson', 'nextLesson'));
    }
}
