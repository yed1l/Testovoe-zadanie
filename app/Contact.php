<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    /**
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User', 'id');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment', 'id');
    }



}
