<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    // fields can be filled
    protected $fillable = ['body', 'user_id', 'contact_id'];

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
