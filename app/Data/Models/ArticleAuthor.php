<?php
namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleAuthor extends BaseModel
{
    protected $table = 'article_authors';

    protected $fillable = ['name', 'article_id'];
}
