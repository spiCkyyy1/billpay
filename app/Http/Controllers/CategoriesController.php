<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
class CategoriesController extends Controller
{
    protected $_helper;
    public function __construct()
    {
        $this->_helper = new Helper();
    }

    public function index(){

        $request = request();

        $categories = new \App\Categories;

        $categories = $categories->where(function($query) use ($request){
            $query->where('name', 'LIKE', '%'.$request->SearchQuery.'%');
        });

        $this->_helper->response()->setHttpCode(200)->send($categories->orderBy('id', request()->orderBy)->paginate());
    }

    public function create(){
        $request = request();

        $this->_helper->runValidation([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'status' => 'required'
        ]);

        $category = new \App\Categories;

        $category->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $this->_helper->response()->setMessage('Category Created Successfully.')->setHttpCode(200)->send('');
    }

    public function edit(){
        $request = request();

        $category = new \App\Categories;

        $category = $category->find($request->categoryId);

        $this->_helper->response()->setHttpCode(200)->send($category);
    }

    public function update(){
        $request = request();

        $this->_helper->runValidation([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $request->id,
            'status' => 'required'
        ]);

        $category = new \App\Categories;

        $category = $category->find($request->id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $this->_helper->response()->setMessage('Category Updated Successfully.')->setHttpCode(200)->send('');
    }

    public function delete(){
        $request = request();

        $category = new \App\Categories;

        $category = $category->find($request->id);

        $category->delete();

        $this->_helper->response()->setMessage('Category Deleted Successfully.')->setHttpCode(200)->send('');


    }
}
