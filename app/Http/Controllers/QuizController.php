<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Course $course)
    {
        $quiz = $course->quiz()->where('is_active', true)->with(['questions.options'])->firstOrFail();
        
        return view('quizzes.show', compact('quiz', 'course'));
    }

    public function submit(Request $request, Course $course)
    {
        $quiz = $course->quiz()->with(['questions.options'])->firstOrFail();
        $answers = $request->input('answers', []);
        
        $totalQuestions = $quiz->questions->count();
        $correctAnswers = 0;

        foreach ($quiz->questions as $question) {
            $selectedOptionId = $answers[$question->id] ?? null;
            $correctOption = $question->options->where('is_correct', true)->first();

            if ($selectedOptionId && $correctOption && $selectedOptionId == $correctOption->id) {
                $correctAnswers++;
            }
        }

        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;
        $passed = $score >= $quiz->passing_score;

        $attempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'passed' => $passed,
        ]);

        return view('quizzes.result', compact('quiz', 'course', 'score', 'passed', 'correctAnswers', 'totalQuestions'));
    }

    public function certificate(Course $course)
    {
        $quiz = $course->quiz()->where('is_active', true)->firstOrFail();
        
        $bestAttempt = auth()->user()->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->where('passed', true)
            ->orderByDesc('score')
            ->first();

        if (!$bestAttempt) {
            return redirect()->route('dashboard')->with('error', 'Debes aprobar el cuestionario para obtener tu certificado.');
        }

        return view('quizzes.certificate', [
            'course' => $course,
            'user' => auth()->user(),
            'attempt' => $bestAttempt,
            'date' => $bestAttempt->created_at->format('d/m/Y'),
        ]);
    }
}
