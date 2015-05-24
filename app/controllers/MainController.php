<?php
class MainController extends BaseController
{
    public function index()
    {
        $title = 'Cac cau hoi moi';
        $questions = Question::with('tags', 'user')->orderBy('id', 'DESC')->paginate(3);

        return View::make('main.index', array(
            'title' => $title,
            'questions' => $questions
        ));
    }
}