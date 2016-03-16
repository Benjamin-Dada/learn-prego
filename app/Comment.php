<?php

namespace Prego;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comments', 'project_id', 'user_id'];
    public function scopeProject($query, $id)
    {
        return $query->where('project_id', $id);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}