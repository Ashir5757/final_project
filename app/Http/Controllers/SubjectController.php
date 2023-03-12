<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Str;
use Mockery\Matcher\Subset;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subjects.index', ['subjects' => Subject::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
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
            'name' => ['required', 'unique:subjects,name'],
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ];

        return Subject::create($data) ? redirect()->back()->with(['success' => 'Magic has been spelled!']) : redirect()->back()->with(['error' => 'Magic has failed to spell!']);

        // if(Subject::create($data)) {
        //     return redirect()->back()->with(['success' => 'Magic has been spelled1']);
        // } else {
        //     return redirect()->back()->with(['error' => 'Magic has failed to spell!']);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => ['required', 'unique:subjects,name,' . $subject->id . ',id'],
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ];

        return $subject->update($data) ? redirect()->back()->with(['success' => 'Magic has been spelled!']) : redirect()->back()->with(['error' => 'Magic has failed to spell!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        return $subject->delete() ? redirect()->back()->with(['success' => 'Magic has been spelled!']) : redirect()->back()->with(['error' => 'Magic has failed to spell!']);
    }
}
