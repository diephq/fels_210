<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Word;
use App\Category;
use Illuminate\Http\Request;
use Session;

class WordController extends Controller
{
    protected $word;
    protected $category;

    public function __construct(Word $word, Category $category)
    {
        $this->word = $word;
        $this->category = $category;
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

        $requestData = $request->all();

        echo json_encode($requestData);die;

        $word = $this->word->create($requestData);

        if (empty($word)) {
            return redirect('admin/word')
                ->withErrors(['error' => trans('message.admin_word.create_error')]);
        }
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
        $word = Word::findOrFail($id);

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
        $word = Word::findOrFail($id);

        return view('admin.word.edit', compact('word'));
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
        
        $requestData = $request->all();
        
        $word = Word::findOrFail($id);
        $word->update($requestData);

        Session::flash('flash_message', 'Word updated!');

        return redirect('admin/word');
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
        Word::destroy($id);

        Session::flash('flash_message', 'Word deleted!');

        return redirect('admin/word');
    }
}
