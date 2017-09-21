<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Image;
use Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role_code = Auth::user()->role_code;
            if($this->role_code == "SITEUSR") {
                echo "Permission Defined";
                die();
            }
            return $next($request);
        });
    }

    public function index()
    {
        $teams = \App\Team::all();
        return view('frontend.teams.index')->with('teams',$teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.teams.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'first_name' => 'required|max:100|alpha_dash',
            'last_name' => 'required|max:100|alpha_dash',
            'designation' => 'required|max:50|alpha_dash',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_url' => 'required_with|url',
            'twitter_url' => 'required_with|url',
            'google_plus_url' => 'required_with|url'
        ],[
            'first_name.required' => 'Please enter first name',
            'first_name.max:100' => 'Not more than 100 characters',
            'first_name.alpha_dash' => 'Must be alphanumeric',
            'last_name.required' => 'Please enter last name',
            'last_name.max:100' => 'Not more than 100 characters',
            'last_name.alpha_dash' => 'Must be alphanumeric',
            'designation.required' => 'Please enter designation',
            'designation.max:50' => 'Not more than 50 characters',
            'designation.alpha_dash' => 'Must be alphanumeric',
            'description.required' => 'Please enter description',
            'image.required' => 'Please select an image',
            'image.mimes:jpeg,png,jpg,gif,svg' => 'Must be image type'
        ])->validate();

        if($request->hasFile('image')) {
            $file = $request->file('image') ;

            $fileName = time().'_'.$file->getClientOriginalName() ;
              
            $destinationPath_2 = public_path().'/upload/teams' ;

            $img = Image::make($file->getRealPath());

              
            $img->resize(128, 128, function ($constraint){
                  $constraint->aspectRatio();
            })->save($destinationPath_2.'/'.$fileName);

        }
        else {
            $fileName = '';
        }

        $team = new \App\Team();
        $team->first_name = $request->first_name;
        $team->last_name = $request->last_name;
        $team->designation = $request->designation;
        $team->description = $request->description;
        $team->image = $fileName;
        $team->facebook_url = $request->facebook_url;
        $team->twitter_url = $request->twitter_url;
        $team->google_plus_url = $request->google_plus_url;
        $team->status = "1";

        if($team->save()) {
            $request->session()->flash("submit-status", "Member added successfully");
            return redirect('/teams');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = \App\Team::find($id);
        return view('frontend.teams.edit')->with('team',$team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(),[
            'first_name' => 'required|max:100|alpha_dash',
            'last_name' => 'required|max:100|alpha_dash',
            'designation' => 'required|max:50|alpha_dash',
            'description' => 'required',
            'image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_url' => 'required_with|url',
            'twitter_url' => 'required_with|url',
            'google_plus_url' => 'required_with|url'
        ],[
            'first_name.required' => 'Please enter first name',
            'first_name.max:100' => 'Not more than 100 characters',
            'first_name.alpha_dash' => 'Must be alphanumeric',
            'last_name.required' => 'Please enter last name',
            'last_name.max:100' => 'Not more than 100 characters',
            'last_name.alpha_dash' => 'Must be alphanumeric',
            'designation.required' => 'Please enter designation',
            'designation.max:50' => 'Not more than 50 characters',
            'designation.alpha_dash' => 'Must be alphanumeric',
            'description.required' => 'Please enter description',
            'image.mimes:jpeg,png,jpg,gif,svg' => 'Must be image type'
        ])->validate();

        $team = \App\Team::find($id);

        if($request->hasFile('image')) {
            $file = $request->file('image') ;

            $fileName = time().'_'.$file->getClientOriginalName() ;
              
            $destinationPath_2 = public_path().'/upload/teams' ;

            $img = Image::make($file->getRealPath());

              
            $img->resize(128, 128, function ($constraint){
                  $constraint->aspectRatio();
            })->save($destinationPath_2.'/'.$fileName);

        }
        else {
            $fileName = $team->image;
        }

        $team->first_name = $request->first_name;
        $team->last_name = $request->last_name;
        $team->designation = $request->designation;
        $team->description = $request->description;
        $team->image = $fileName;
        $team->facebook_url = $request->facebook_url;
        $team->twitter_url = $request->twitter_url;
        $team->google_plus_url = $request->google_plus_url;
        $team->status = "1";

        if($team->save()) {
            $request->session()->flash("submit-status", "Member updated successfully");
            return redirect('/teams');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $team = \App\Team::find($id);
        if($team->delete()) {
            $request->session()->flash("submit-status", "Member deleted successfully");
        }
        else {
            $request->session()->flash("submit-status", "Please try again");
        }
        return redirect('/teams');
    }
}
