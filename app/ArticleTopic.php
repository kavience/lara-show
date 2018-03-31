<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTopic extends Model
{
    protected $fillable = ['topic_id', 'article_id'];
}
