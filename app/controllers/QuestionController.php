<?php
class QuestionController extends BaseController
{
    public function getCreate()
    {
        $categories = Category::lists('title', 'id');

        return View::make('question.create', array(
            'title' => 'Dat cau hoi moi',
            'categories' => $categories,
        ));
    }

    public function postCreate()
    {
        $valid = Validator::make(Input::all(), Question::$createRules, Question::$messages);

        if ($valid->passes()) {
            # code...
        } else {
            return Redirect::route('question_create_get')->with('error', $valid->errors()->first());
        }
    }
}
