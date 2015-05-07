<?php
class Tag extends Eloquent
{
    protected $fillable = array('tag', 'alias');
    protected $table = 'tags';

    public function questions()
    {
        return $this->belongsToMany('Question', 'question_tag')->withTimestamps();
    }
}