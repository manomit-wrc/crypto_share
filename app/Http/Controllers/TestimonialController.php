<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function index() {
    	return view('frontend.testimonial_view');
    }

    public function testimonial_add() {
    	return view('frontend.testimonial_add');
    }
}
