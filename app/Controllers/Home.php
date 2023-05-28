<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	public function index()
	{
		
		$tags = model('tagsModel');

		$tags = $tags->findAll();

		$data = [
			'tags' => $tags
		];
		return view('Dashboard', $data);
	}
}
