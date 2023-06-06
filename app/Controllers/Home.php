<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	public function index()
	{
		
		$categories = model('CategoryModel');

		$categories = $categories->findAll();

		$data = [
			'tags' => $categories
		];
		return view('Dashboard', $data);
	}
}
