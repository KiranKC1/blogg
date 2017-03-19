<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller{

	public function getIndex(){
		$posts = Post::orderBy('created_at','desc')->limit(4)->get();

		return view('pages.welcome')->withPosts($posts);

	}

	public function getAbout(){
		$first="kiran";
		$email='kiran_cool78@yahoo.com';

		return view('pages.about')->with("fullname",$first)->with("email",$email);

	}

	public function getContact(){
		return view('pages.contact');

	}
}