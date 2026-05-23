<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['module_id', 'title', 'status', 'sort_order'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
