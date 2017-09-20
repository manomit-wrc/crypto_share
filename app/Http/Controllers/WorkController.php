<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Work;
use Validator;

class WorkController extends Controller
{
    public function index() {
    	$work = Work::All();
    	return view('frontend.work_view')->with('all_work', $work);
    }

    public function work_add() {
    	return view('frontend.work_add');
    }

    public function insert_work(Request $request) {
        Validator::make($request->all(),[
            'title' => 'required|max:50|unique:works,title',
            'description' => 'required',
            'image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();

        $work = new Work();
        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = ;
        $work->status = $request->status;

        if($work->save()){
            $request->session()->flash("submit-status", "Work added successfully.");
            return redirect('/work');
        }else{
            $request->session()->flash("submit-status", "Work added failed.");
            return redirect('/work/add');
        }
    }

    public function work_edit($id) {
    	$work = Work::find($id);
    	return view('frontend.work_edit')->with('work', $work);
    }

    public function update_work(Request $request) {
    	$id = $request->work_id;
        Validator::make($request->all(),[
            'title' => 'required|max:50|unique:works,title',
            'description' => 'required',
            'image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();

        $work = Work::find($id);
        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = ;
        $work->status = $request->status;

        if($work->save()){
            $request->session()->flash("submit-status", "Work updated successfully.");
            return redirect('/work');
        }else{
            $request->session()->flash("submit-status", "Work edit failed.");
            return redirect('/work/edit/'.$id);
        }
    }

    public function delete_work($id, Request $request) {
    	$work = Work::find($id);
    	if ($work->delete()) {
    		$request->session()->flash("submit-status", "Work deleted successfully.");
            return redirect('/work');
    	} else {
    		$request->session()->flash("submit-status", "Work delete failed.");
            return redirect('/work/');
    	}
    }
}
