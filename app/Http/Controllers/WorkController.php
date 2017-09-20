<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();

		if($request->hasFile('image')) {
			$file = $request->file('image');
			$fileName = time().'_'.$file->getClientOriginalName();
			//thumb destination path
			$destinationPath_2 = public_path().'/upload/work_image/resize/';
			$img = Image::make($file->getRealPath());
			$img->resize(280, 210, function ($constraint){
			$constraint->aspectRatio();
			})->save($destinationPath_2.'/'.$fileName);
			//original destination path
			$destinationPath = public_path().'/upload/work_image/original/';
			$file->move($destinationPath, $fileName);
		} else {
			$fileName = "";
		}

        $work = new Work();
        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = $fileName;
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
            'title' => 'required|max:50|unique:works,title,'.$id,
            'description' => 'required',
            'image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ])->validate();

        $work = Work::find($id);

        if($request->hasFile('image')) {
			$file = $request->file('image');
			$fileName = time().'_'.$file->getClientOriginalName();
			//thumb destination path
			$destinationPath_2 = public_path().'/upload/work_image/resize/';
			$img = Image::make($file->getRealPath());
			$img->resize(280, 210, function ($constraint){
			$constraint->aspectRatio();
			})->save($destinationPath_2.'/'.$fileName);
			//original destination path
			$destinationPath = public_path().'/upload/work_image/original/';
			$file->move($destinationPath, $fileName);
		} else {
			$fileName = $work->image;
		}

        $work->title = $request->title;
        $work->description = $request->description;
        $work->image = $fileName;
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
