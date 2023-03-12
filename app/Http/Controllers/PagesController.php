<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function subjects()
    {
        $route_name = explode('.', Route::currentRouteName());
        if (end($route_name) == 'prepare') {
            $route = 'select.topics.prepare';
        } elseif (end($route_name) == 'practice') {
            $route = 'select.topics.practice';
        }

        return view('web-pages.subjects', [
            'subjects' => Subject::all(),
            'route' => $route
        ]);
    }

    public function topics(Subject $subject)
    {
        $route_name = explode('.', Route::currentRouteName());
        if (end($route_name) == 'prepare') {
            $route = 'prepare';
        } elseif (end($route_name) == 'practice') {
            $route = 'practice';
        }

        return view('web-pages.topics', [
            'topics' => Topic::where('subject_id', $subject->id)->get(),
            'route' => $route
        ]);
    }

    public function prepare(Subject $subject, Topic $topic)
    {
        return view('web-pages.prepare', [
            'questions' => Question::where('topic_id', $topic->id)->get(),
            'subject' => $subject,
        ]);
    }

    public function practice(Subject $subject, Topic $topic)
    {
        $total = Question::where('topic_id', $topic->id)->count();
        $question = Question::with('choices')->where('topic_id', $topic->id)->first();
        return view('web-pages.practice', [
            'question' => $question,
            'total' => $total
        ]);
    }
//     public function search(Request $request)
// {
//     $query = $request->input('query');
//     $questions = Question::where('text', 'like', '%'.$query.'%')->get();
//     return view('web-pages.search', compact('questions'));
// }

}
