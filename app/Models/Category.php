<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    public $timestamps = false;

    public function words()
    {
    	return $this->hasMany('App\Models\Word');
    }

    public function records()
    {
        return $this->hasMany('App\Models\Record');
    }

}
