<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;
use Validator;

class TestimonialController extends Controller
{
    public function index() {
    	$testimonial = Testimonial::All();
    	return view('frontend.testimonial_view')->with('all_testimonial', $testimonial);
    }

    public function testimonial_add() {
    	return view('frontend.testimonial_add');
    }

    public function insert_testimonial(Request $request) {
        Validator::make($request->all(),[
            'client_name' => 'required|max:50|unique:testimonials,client_name',
            'client_desg' => 'required',
            'client_comments' => 'required'
        ])->validate();

        $testimonial = new Testimonial();
        $testimonial->client_name = $request->client_name;
        $testimonial->client_designation = $request->client_desg;
        $testimonial->client_comment = $request->client_comments;

        if($testimonial->save()){
            $request->session()->flash("submit-status", "Testimonial added successfully.");
            return redirect('/testimonial');
        }else{
            $request->session()->flash("submit-status", "Testimonial added failed.");
            return redirect('/testimonial/add');
        }
    }

    public function testimonial_edit($id) {
    	$testimonial = Testimonial::find($id);
    	return view('frontend.testimonial_edit')->with('testimonial', $testimonial);
    }

    public function update_testimonial(Request $request) {
    	$id = $request->testimonial_id;
        Validator::make($request->all(),[
            'client_name' => 'required|max:50|unique:testimonials,client_name',
            'client_desg' => 'required',
            'client_comments' => 'required'
        ])->validate();

        $testimonial = Testimonial::find($id);
        $testimonial->client_name = $request->client_name;
        $testimonial->client_designation = $request->client_desg;
        $testimonial->client_comment = $request->client_comments;

        if($testimonial->save()){
            $request->session()->flash("submit-status", "Testimonial updated successfully.");
            return redirect('/testimonial');
        }else{
            $request->session()->flash("submit-status", "Testimonial edit failed.");
            return redirect('/testimonial/edit/'.$id);
        }
    }

    public function delete_testimonial($id, Request $request) {
    	$testimonial = Testimonial::find($id);
    	if ($testimonial->delete()) {
    		$request->session()->flash("submit-status", "Testimonial deleted successfully.");
            return redirect('/testimonial');
    	} else {
    		$request->session()->flash("submit-status", "Testimonial delete failed.");
            return redirect('/testimonial/');
    	}
    }
}
