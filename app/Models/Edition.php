<?php
namespace App\Models;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edition extends BaseModel
{
    use HasFactory;

    protected $fillable = ['year', 'month', 'number', 'published_at'];

    protected $appends = ['month_name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function getMonthNameAttribute()
    {
        return Date::parse(sprintf('%s-%s-%s', $this->year, $this->month, 1))->format('F');
    }
}
