<?php
class Category extends Eloquent
{
    protected $table = 'categories';
    protected $fillable = array('title');

    public function questions()
    {
        return $this->hasMany('Question', 'category_id');
    }
}