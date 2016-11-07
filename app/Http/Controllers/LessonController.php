<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Word;
use App\Result;
use App\Lesson;
use App\Category;
use DB;
use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LessonController extends Controller
{
    protected $word;
    protected $result;
    protected $lesson;
    protected $category;

    public function __construct(Word $word, Result $result, Lesson $lesson, Category $category)
    {
        $this->word = $word;
        $this->result = $result;
        $this->lesson = $lesson;
        $this->category = $category;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->lesson->rules);

        DB::beginTransaction();
        try {
            // create lesson
            $lesson = $this->lesson->create([
                'type' => $request->input('lesson_type'),
                'category_id' => $request->input('category_id'),
                'user_id' => $request->input('user_id')
            ]);

            // get lists words for this lesson
            $words = $this->word->getListWordByCategoryId([
                'category_id' => $request->get('category_id'),
                'type' => $request->get('lesson_type')
            ]);

            // get list word id
            $results = [];
            foreach ($words as $word) {
                $results []  =  [
                    'word_id' => $word->id,
                    'lesson_id' => $lesson->id
                ];
            }

            // create answers sheet
            $this->result->createResult($results);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('categories')
                ->withErrors(['error' => trans('message.create_lesson_error')])
                ->withInput();
        }
        DB::commit();

        return redirect(action('LessonController@show', ['id' => $request->get('category_id'), 'lessonId' => $lesson->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $categoryId
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId, $id)
    {
        try {
            $category = $this->category->findOrFail($categoryId);
            $lesson = $this->lesson->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        if ($lesson->category_id != $categoryId) {
            return abort(404);
        }

        // Get list words for user
        $results = $this->result->getListAnswerSheet($lesson->id);

        return view('lesson/detail', compact('results', 'lesson', 'category'));

    }

    /**
     * check answers
     *
     * @param Request $request
     * @param int $id
     * @param int $categoryId
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function answer(Request $request,$categoryId, $id)
    {
        try {
            $this->category->findOrFail($categoryId);
            $lesson = $this->lesson->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        if ($lesson->category_id != $categoryId) {
            return abort(404);
        }

        // save answers in db
        $words = $request->input('word_id');

        $this->result->insertAnswers($words, $id);

        // get result of user
        $results = $this->result->getResult($id);

        $score = 0;
        foreach ($results as $result) {
            if (!empty($result->answer->is_correct)) {
                $score++;
            }
        }

        // save score in lesson table
        $this->lesson->updateScore([
            'id' => $id,
            'score' => (int) $score,
            'status' => config('constants.LESSON_TESTED')
        ]);

        return redirect(route('category_detail', ['id' => $categoryId]));
    }

}
