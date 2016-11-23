<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Word;
use App\Category;
use Illuminate\Http\Request;
use Session;
use DB;

class WordController extends Controller
{
    protected $word;
    protected $category;
    protected $answer;

    public function __construct(Word $word, Category $category, Answer $answer)
    {
        $this->word = $word;
        $this->category = $category;
        $this->answer = $answer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $word = $this->word->getListWordAdmin();

        return view('admin.word.index', compact('word'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->category->all();

        return view('admin.word.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->word->rules);

        $trueAnswer = $request->get('true_answer');

        $answers = $request->get('answer');

        DB::beginTransaction();
        try {
            $word = $this->word->create([
                'category_id' => $request->get('category_id'),
                'text' => $request->get('text')
            ]);

            $params = [];
            foreach ($answers as $key => $answer) {
                $params [] = [
                    'text' => $answer,
                    'is_correct' => $key + 1 == $trueAnswer ? config('constants.TRUE_ANSWER') : config('constants.FALSE_ANSWER'),
                    'word_id' => $word->id
                ];
            }

            $this->answer->insert($params);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('admin/word')
                ->withErrors(['error' => trans('message.admin_word.create_error')]);
        }
        DB::commit();

        return redirect('admin/word')
            ->with(['alert-success' => trans('message.admin_word.create_success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $word = $this->word->getWordDetail($id);

        if (empty($word)) {
            abort(404);
        }

        return view('admin.word.show', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $word = $this->word->getWordDetail($id);

        $categories = $this->category->all();

        return view('admin.word.edit', compact('word', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $word = $this->word->findOrFail($id);

        $this->validate($request, $this->word->rules);

        DB::beginTransaction();
        try {
            $word->update([
                'category_id' => $request->get('category_id'),
                'text' => $request->get('text')
            ]);

            // remove answers
            $this->answer->where('word_id', $id)->delete();

            $answers = $request->get('answer');
            $trueAnswer = $request->get('true_answer');

            $params = [];
            foreach ($answers as $key => $answer) {
                $params [] = [
                    'text' => $answer,
                    'is_correct' => $key + 1 == $trueAnswer ? config('constants.TRUE_ANSWER') : config('constants.FALSE_ANSWER'),
                    'word_id' => $word->id
                ];
            }

            $this->answer->insert($params);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('admin/word')
                ->withErrors(['error' => trans('message.admin_word.update_error')]);
        }
        DB::commit();

        return redirect('admin/word')
            ->with(['alert-success' => trans('message.admin_word.update_success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->word->destroy($id);

        // remove answers
        $this->answer->where('word_id', $id)->delete();

        return redirect('admin/word')
            ->with(['alert-success' => trans('message.admin_word.delete_success')]);
    }
}
