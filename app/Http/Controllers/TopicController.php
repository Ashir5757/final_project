<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.topics.index', [
            'subjects' => Subject::all(),
            'topics' => Topic::with('subject')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topics.create', ['subjects' => Subject::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'name' => ['required'],
        ]);

        $data = [
            'subject_id' => $request->subject,
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name)
        ];

        Topic::create($data) ?  $message['success'] = 'Magic has been spelled!' : $message['error'] = 'Magic has failed to spell!';

        return redirect()->back()->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', [
            'topic' => $topic,
            'subjects' => Subject::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'subject' => ['required'],
            'name' => ['required'],
        ]);

        $data = [
            'subject_id' => $request->subject,
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name)
        ];

        $message = [];

        $topic->update($data) ? $message['success'] = 'Magic has been spelled!' : $message['error'] = 'Magic has failed to spell!';

        return redirect()->back()->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete() ? $message['success'] = 'Magic has been spelled!' : $message['error'] = 'Magic has failed to spell!';

        return redirect()->back()->with($message);
    }
}
