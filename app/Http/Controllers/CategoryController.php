<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Lesson;
use Validator;
use App\Http\Requests;

class CategoryController extends Controller
{
    protected $category;
    protected $lesson;

    public function __construct(Category $category, Lesson $lesson)
    {
        $this->category = $category;
        $this->lesson = $lesson;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->paginate(config('constants.PAGINATE_COMMON'));

        return view('category/index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if (!$category = $this->category->findOrFail($id)) {
            return redirect('categories')
                ->withErrors(['error' => trans('message.lesson_not_found')]);
        }

        $lessons = $this->lesson->getDetail([
            'category_id' => $id,
            'user_id' => $user->id
        ]);

        return view('category/detail', compact('category', 'user', 'lessons'));
    }

}
