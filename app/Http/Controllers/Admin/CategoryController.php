<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get list categories
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $category = $this->category->paginate(config('constants.PAGINATE_ADMIN'));

        return view('admin.category.index', compact('category'));
    }

    /**
     * Show form create category
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Save category
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->category->rules);

        $requestData = $request->all();

        $category = $this->category->create($requestData);

        if (empty($category)) {
            return redirect('admin/category')
                ->withErrors(['error' => trans('message.category.create_error')]);
        }
        return redirect('admin/category')
            ->with(['alert-success' => trans('message.category.create_success')]);
    }

    /**
     * Show category
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);

        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form category
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the category
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, $this->category->rules);

        $requestData = $request->all();

        $category = $this->category->findOrFail($id);

        $result = $category->update($requestData);

        if (empty($result)) {
            return redirect('admin/category')
                ->withErrors(['error' => trans('message.category.update_error')]);
        }
        return redirect('admin/category')
            ->with(['alert-success' => trans('message.category.update_success')]);
    }

    /**
     * Remove the category
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);

        $category->destroy($id);

        return redirect('admin/category')
            ->with(['alert-success' => trans('message.category.delete_success')]);
    }
}
