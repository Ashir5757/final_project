<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');



Route::controller(AuthController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', 'login_view')->name('login');
    Route::post('login', 'login');

    Route::post('logout', 'logout')->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware(Authenticate::class)->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::controller(SubjectController::class)->group(function () {
        Route::get('subjects', 'index')->name('subjects');
        Route::get('subject/create', 'create')->name('subject.create');
        Route::post('subject/create', 'store');
        Route::get('subject/{subject}/edit', 'edit')->name('subject.edit');
        Route::post('subject/{subject}/edit', 'update');
        Route::post('subject/{subject}/destroy', 'destroy')->name('subject.delete');
    });

    Route::controller(TopicController::class)->group(function () {
        Route::get('topics', 'index')->name('topics');
        Route::get('topic/create', 'create')->name('topic.create');
        Route::post('topic/create', 'store');
        Route::get('topic/{topic}/edit', 'edit')->name('topic.edit');
        Route::post('topic/{topic}/edit', 'update');
        Route::post('topic/{topic}/destroy', 'destroy')->name('topic.delete');
    });

    Route::controller(QuestionController::class)->group(function () {
        Route::get('questions', 'index')->name('questions');
        Route::get('question/create', 'create')->name('question.create');
        Route::post('question/create', 'store');
        Route::get('question/{question}/edit', 'edit')->name('question.edit');
        Route::post('question/{question}/edit', 'update');
        Route::post('question/{question}/destroy', 'destroy')->name('question.delete');
    });

    Route::controller(DynamicController::class)->group(function () {
        Route::post('subject/topics', 'fetch_topics')->name('subject.topics');
        Route::post('topics/fetch/all', 'fetch_all_topics')->name('topics.fetch.all');
        Route::post('question/subject/topic', 'fetch_questions_topic')->name('question.subject.topic');
        Route::post('question/topic/questions', 'fetch_questions_all')->name('question.topic.questions');
    });
});

Route::controller(PagesController::class)->group(function () {
    Route::get('select-subject/prepare', 'subjects')->name('select.subjects.prepare');
    Route::get('select-topic/prepare/{subject:slug}', 'topics')->name('select.topics.prepare');
    Route::get('prepare/{subject:slug}/{topic:slug}', 'prepare')->name('prepare');

    Route::get('select-subject/practice', 'subjects')->name('select.subjects.practice');
    Route::get('select-topic/practice/{subject:slug}', 'topics')->name('select.topics.practice');
    Route::get('practice/{subject:slug}/{topic:slug}', 'practice')->name('practice');

    Route::get('/search', [QuestionController::class,"search"])->name('questions.search');
});

Route::controller(DynamicController::class)->group(function () {
    Route::post('question/check', 'check_question')->name('question.check');
});


