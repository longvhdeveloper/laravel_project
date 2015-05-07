<?php
class Question extends Eloquent
{
    protected $fillable = array('title', 'conent', 'view', 'vote');
    protected $table = 'questions';

    public static $createRules = array(
        'title' => 'required|min:5',
        'content' => 'required|min:10'
    );

    public static $messages = array(
        'title.required' => 'Vui long nhap title',
        'title.min' => 'Title toi thieu la :min ky tu',
        'content.required' => 'Vui long nhap content',
        'content.min' => 'Content toi thieu la :min ky tu',
    );

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag', 'question_tag')->withTimestamps();
    }
}
