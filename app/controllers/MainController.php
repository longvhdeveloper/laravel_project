<?php
class MainController extends BaseController
{
    public function index()
    {
        return View::make('main.index', array(
            'title' => 'Home page'
        ));
    }
}