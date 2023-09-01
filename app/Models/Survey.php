<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['questions'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ( isset($filters['id']) ) {
            $query->whereHas('questions', function ($query) use ($filters){
                $query->where('survey_id', '=', $filters['id']);
            });
        }
    }
}
