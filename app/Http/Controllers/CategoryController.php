<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission: الفئات', ['only' => ['index']]);
        $this->middleware('permission:إضافة فئة', ['only' => ['store']]);
        $this->middleware('permission:تعديل فئة', ['only' => ['update']]);
        $this->middleware('permission:حذف فئة', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sections = section::all();
        $categories =category::all()->sortByDesc('id');
        return view('categories.categories',compact('categories','sections'));


    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections|max:255',
            'section_id' => 'required',
        ],[
        'name.required' => 'حقل الاسم مطلوب',
        'name.unique' => 'لقد تم استخدام الاسم بالفعل',
        'section_id.unique' => 'يرجى اختيار بنك'

        ]);
        category::create([
            'name' =>  $request->name,
            'section_id' =>  $request->section_id,
            'description' =>  $request->description,
        ]);
        session()->flash('Add');
        return redirect(route('categories.index'));

    }

    public function update(Request $request)
    {   $id = $request->id;

        $request->validate([
            'name' => 'required|max:255|unique:sections,name,'.$id,
            'section_id' => 'required',
        ],[
            'name.required' => 'حقل الاسم مطلوب',
            'name.unique' => 'لقد تم استخدام الاسم بالفعل',
            'section_id.unique' => 'يرجى اختيار بنك'
        ]);
        $category = category::findOrfail($id);
        $category->where('id',$id)->update([
            'name' =>  $request->name,
            'section_id' =>  $request->section_id,
            'description' =>  $request->description,
        ]);
        session()->flash('edit');
        return redirect(route('categories.index'));
    }

    public function destroy(Request $request)
    {
        $id= $request->id;
        $category= category::findOrfail($id);
        $category->delete();
        session()->flash('delete');
        return redirect(route('categories.index'));
    }
}
