<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pricing;
use Validator;

class PricingController extends Controller
{
	public function index() {
    	$pricing = Pricing::All();
    	return view('frontend.pricing_view')->with('all_pricing', $pricing);
    }

    public function pricing_add() {
    	return view('frontend.pricing_add');
    }

    public function insert_pricing(Request $request) {
        Validator::make($request->all(),[
            'pricing_title' => 'required|max:50|unique:pricings,pricing_title',
            'pricing_amount' => 'required',
            'storage' => 'required',
            'no_of_clients' => 'required',
            'active_projects' => 'required',
            'colors' => 'required',
            'goodies' => 'required',
            'email_support' => 'required'
        ])->validate();

        $pricing = new Pricing();
        $pricing->pricing_title = $request->pricing_title;
        $pricing->pricing_amount = $request->pricing_amount;
        $pricing->storage = $request->storage;
        $pricing->no_of_clients = $request->no_of_clients;
        $pricing->active_projects = $request->active_projects;
        $pricing->colors = $request->colors;
        $pricing->goodies = $request->goodies;
        $pricing->email_support = $request->email_support;
        $pricing->status = $request->status;

        if($pricing->save()){
            $request->session()->flash("submit-status", "Pricing added successfully.");
            return redirect('/pricing');
        }else{
            $request->session()->flash("submit-status", "Pricing added failed.");
            return redirect('/pricing/add');
        }
    }

    public function pricing_edit($id) {
    	$pricing = Pricing::find($id);
    	return view('frontend.pricing_edit')->with('pricing', $pricing);
    }

    public function update_pricing(Request $request) {
    	$id = $request->pricing_id;
        Validator::make($request->all(),[
            'pricing_title' => 'required|max:50|unique:pricings,pricing_title,'.$id,
            'pricing_amount' => 'required',
            'storage' => 'required',
            'no_of_clients' => 'required',
            'active_projects' => 'required',
            'colors' => 'required',
            'goodies' => 'required',
            'email_support' => 'required'
        ])->validate();

        $pricing = Pricing::find($id);
        $pricing->pricing_title = $request->pricing_title;
        $pricing->pricing_amount = $request->pricing_amount;
        $pricing->storage = $request->storage;
        $pricing->no_of_clients = $request->no_of_clients;
        $pricing->active_projects = $request->active_projects;
        $pricing->colors = $request->colors;
        $pricing->goodies = $request->goodies;
        $pricing->email_support = $request->email_support;
        $pricing->status = $request->status;

        if($pricing->save()){
            $request->session()->flash("submit-status", "Pricing updated successfully.");
            return redirect('/pricing');
        }else{
            $request->session()->flash("submit-status", "Pricing edit failed.");
            return redirect('/pricing/edit/'.$id);
        }
    }

    public function delete_pricing($id, Request $request) {
    	$pricing = Pricing::find($id);
    	if ($pricing->delete()) {
    		$request->session()->flash("submit-status", "Pricing deleted successfully.");
            return redirect('/pricing');
    	} else {
    		$request->session()->flash("submit-status", "Pricing delete failed.");
            return redirect('/pricing/');
    	}
    }
}
