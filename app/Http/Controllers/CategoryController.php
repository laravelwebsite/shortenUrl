<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function addCategory()
    {
    	$cate=Category::orderBy('id','DESC')->paginate(10);
    	return view('admin.pages.addcategory',['cate'=>$cate]);
    }
    public function editCategory($id)
    {
    	$id=(int)$id;
    	$cate=Category::find($id);
    	return view('admin.pages.editcategory',['cate'=>$cate]);
    }
}
