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

        // Get courses user has purchased (status=completed)
        $myCourses = $user->courses;

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
        // Check if already owned
        if (Auth::user()->courses()->where('courses.id', $course->id)->exists()) {
            return redirect()->route('dashboard')->with('error', 'Ya tienes este curso.');
        }

        // Mock Enrollment: Create a completed order directly
        Order::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'payment_method' => 'deposit', // Mock value
            'status' => 'completed',
            'amount' => $course->price,
            'proof_of_payment_path' => null,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Te has inscrito al curso correctamente!');
    }
}
