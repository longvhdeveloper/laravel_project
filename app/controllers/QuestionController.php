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
            $question = Question::create(array(
                'title' => Input::get('title'),
                'content' => Input::get('content'),
                'category_id' => (int)Input::get('category'),
                'user_id' => (int)Sentry::getUser()->id,
                'view' => 0,
                'vote' => 0
            ));

            $questionId = $question->id;
            $question = Question::find($questionId);

            if (Str::length(Input::get('tag'))) {
                $tag_array = explode(',', Input::get('tag'));
                if (count($tag_array)) {
                    foreach ($tag_array as $key => $value) {
                        $tagData = trim(strtolower($value));
                        $tagAlias = Unicode::make($tagData);

                        $tag = Tag::where('alias', $tagAlias);
                        if ($tag->count() == 0) {
                            $tagInfo = Tag::create(array(
                                'tag' => $tagData,
                                'alias' => $tagAlias
                            ));
                        } else {
                            $tagInfo = $tag->first();
                        }

                        $question->tags()->attach($tagInfo->id);
                    }
                }

                return Redirect::route('question_create_get')->with('success', 'Cau hoi cua ban da duoc gui. Xem lai no tai day');
            }
        } else {
            return Redirect::route('question_create_get')->with('error', $valid->errors()->first());
        }
    }
}
