<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crud;
use Session;

class CrudController extends Controller
{
    public function showData(){
        $showData  = crud::all();
        return view('show_data',compact('showData'));
    }
    public function addData(){
        return view('add_data');
    }
    public function storeData(Request $request){
        $rules = [
            'name'=>'required|max:10',
            'email'=>'required|email',
        ];
        $cm = [
            'name.required' => 'Enter Your Name',
            'name.max' => 'Your name can not contain more then 10 ch',
            'email.required' => 'Enter Youe Email',
            'email.email' => 'Email must be a valid email',
        ];
        $this->validate($request, $rules, $cm);

        $crud = new crud();
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->save();
         
        Session::flash('msg','Data Successfuly added');

        return redirect()->back();
    }
}
