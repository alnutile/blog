<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function scopePublished($query)
    {
        return $query->where("active", "=", 1);
    }

    public function scopeOrderByCreatedAt($query)
    {
        return $query->orderBy('created_at', null, true);
    }
}
