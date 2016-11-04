<?php

namespace Graemekilkenny\ApartmentCMS\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function findBySlug($slug)
    {
        $bucket = $this->where('slug', $slug)->first();

        if( ! $bucket ){
            return false;
        }

        return $bucket;
    }
}
