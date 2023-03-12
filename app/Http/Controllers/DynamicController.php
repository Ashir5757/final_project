<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DynamicController extends Controller
{
    public function fetch_topics()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $topics = Topic::where('subject_id', $data['subjectId'])->get();
        if (count($topics) > 0) {
            $output = '<option value="" selected hidden disabled>Select the topic</option>';
            foreach ($topics as $topic) {
                $output .= '<option value="' . $topic->id . '">' . $topic->name . '</option>';
            }
        } else {
            $output = '<option value="">No Topic Found!</option>';
        }
        echo json_encode($output);
    }

    //For Questions web page
    public function fetch_questions_topic()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $topics = Topic::where('subject_id', $data['subjectId'])->get();
        if (count($topics) > 0) {
            $output = '<option value="" selected hidden disabled>Select the topic</option>';
            foreach ($topics as $topic) {
                $output .= '<option value="' . $topic->id . '">' . $topic->name . '</option>';
            }
        } else {
            $output = '<option value="">No Topic Found!</option>';
        }
        echo json_encode($output);
    }


    //For Questions web page
    public function fetch_questions_all()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $questions = Question::where('topic_id', $data['topicId'])->get();
        // echo json_encode ($questions);
        if (count($questions) > 0) {
            $output = '';
            foreach ($questions as $question) {
                $output .= '<div class="card shadow-lg"><div class="card-header pb-0"><div class="row"><div class="col-md-10"><h5>Question:' . $question->text . '</h5></div><div class="col-md-2"><a href="' . route('admin.question.edit', $question) . '" class="btn btn-primary">Edit</a><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteQuestion(' . $question . ')">Delete</button></div></div><div class="row"><div class="col-12"><ol>';
                foreach ($question->choices as $choice) {
                    $output .= '<li>' . $choice->text . '</li>';
                }
                $output .= '</ol></div></div><div class="row"><div class="col-md-12"><h5>Explanation:' . $question->explanation . '</h5></div></div></div></div>';
            }
        } else {
            $output = '<option value="">No Topic Found!</option>';
        }


        echo json_encode($output);
    }

    //For topics webpage
    public function fetch_all_topics()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $topics = Topic::where('subject_id', $data['subjectId'])->get();
        if (count($topics) > 0) {
            $output = '<table class="table table-bordered"><thead><tr><th>Sr. No.</th><th>Subject</th><th>Name</th><th>Slug</th><th>Action</th></tr></thead><tbody>';
            foreach ($topics as $topic) {
                $output .= '<tr><td> number </td><td>' . $topic->subject->name . '</td><td>' . $topic->name . '</td><td>' . $topic->slug . '</td><td><a href="' . route('admin.topic.edit', $topic) . '"class="btn btn-primary">Edit</a><button type="button" class="btn btn-danger"data-bs-toggle="modal"data-bs-target="#deleteModal"onclick="deletetopic({{ $topic }})">Delete</button></td></tr>';
            }
            '</tbody></table>';
        } else {
            $output =  '<div class="alert alert-danger">No record Found!</div>';
        }
        echo json_encode($output);
    }

    public function check_question()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $choice = Choice::with('question')->where([
            ['id', $data['choice_id']]
        ])->first();

        if ($choice->is_correct == 1) {
            $status = 'Correct';
        } else {
            $status = 'Incorrect';
        }

        // $question = Question::find($choice->question_id);
        // $questions = Question::where('topic_id', $question->topic_id)->get();
        // $questions = $choice->question->topic->questions;



        if ($data['currentQuestion'] < count($choice->question->topic->questions)) {

            $next_question = $choice->question->topic->questions->get($data['currentQuestion']);

            Session::put('_token', sha1(microtime()));
            $new_token = session()->get('_token');

            $response = [
                'new_token' => $new_token,
                'status' => $status,
                'current' => $data['currentQuestion'],
                'total' => count($choice->question->topic->questions),
                'next_question' => $next_question,
                'choices' => $next_question->choices
            ];
        } else {
            $response = [
                'status' => $status,
                'end' => true
            ];
        }

        echo json_encode($response);
    }
}
