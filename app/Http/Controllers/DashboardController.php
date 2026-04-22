<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get courses user has purchased (status=completed) with quiz info and lessons
        $myCourses = $user->courses()->with(['quiz' => function($query) {
            $query->where('is_active', true);
        }, 'lessons'])->get();

        // Calculate progress for each course
        $myCourses->each(function($course) use ($user) {
            $totalLessons = $course->lessons->count();
            if ($totalLessons > 0) {
                $completedCount = $user->completedLessons()
                    ->whereIn('lesson_id', $course->lessons->pluck('id'))
                    ->count();
                $course->progress_percent = round(($completedCount / $totalLessons) * 100);
                $course->completed_count = $completedCount;
                $course->total_count = $totalLessons;
            } else {
                $course->progress_percent = 0;
                $course->completed_count = 0;
                $course->total_count = 0;
            }
        });

        // Get courses user does NOT own (whereNotIn)
        // Note: This logic assumes 'owned' means having a COMPLETED order.
        // If a pending order exists, it's still "available" to buy (or retry).
        $purchasedCourseIds = $myCourses->pluck('id');

        $availableCourses = Course::whereNotIn('id', $purchasedCourseIds)
            ->where('is_published', true)
            ->get();

        return view('dashboard', compact('myCourses', 'availableCourses'));
    }

    public function enroll(Course $course)
    {
        return redirect()->route('checkout.show', $course);
    }
}
