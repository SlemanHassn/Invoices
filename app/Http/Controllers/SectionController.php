<?php

namespace App\Http\Controllers;

use App\Models\imageUser;
use App\Models\section;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class SectionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:البنوك', ['only' => ['index','show']]);
        $this->middleware('permission:إضافة بنك', ['only' => ['store']]);
        $this->middleware('permission:تعديل بنك', ['only' => ['update']]);
        $this->middleware('permission:حذف بنك', ['only' => ['destroy']]);
    }

    public function index()
    {
    $sections=section::all()->sortByDesc('id');
        return view('sections.sections',compact('sections'));
    }


    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|unique:sections|max:255',
    ],[
        'name.required' => 'حقل الاسم مطلوب',
        'name.unique' => 'لقد تم استخدام الاسم بالفعل'

    ]);
        section::create([
            'name' =>  $request->name,
            'description' =>  $request->description,
        ]);
        


        session()->flash('Add');
        return redirect(route('sections.index'));
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
        'name' => 'required|max:255|unique:sections,name,'.$id,
    ],[
        'name.required' => 'حقل الاسم مطلوب',
        'name.unique' => 'لقد تم استخدام الاسم بالفعل'

    ]);
        $section = section::findOrfail($id);
        $section->where('id',$id)->update([
            'name' =>  $request->name,
            'description' =>  $request->description,
        ]);
        session()->flash('edit');
        return redirect(route('sections.index'));
    }

    public function destroy(Request $request)
    {
        $id= $request->id;
        $section= section::findOrfail($id);
        $section->delete();
          session()->flash('delete');
        return redirect(route('sections.index'));

    }
}
