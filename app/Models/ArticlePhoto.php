<?php
namespace App\Models;

use App\Models\BaseModel;
use App\Models\Article;

class ArticlePhoto extends BaseModel
{
    protected $table = 'article_photos';

    protected $fillable = ['article_id', 'author', 'url_highres', 'url_lowres', 'notes'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
