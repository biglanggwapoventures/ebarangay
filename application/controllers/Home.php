<?php

class Home extends EB_Controller
{

	protected $tab_title = 'Home';
	protected $active_nav = NAV_HOME;

	public function index()
	{
            $this->generate_page('home');
	}
}