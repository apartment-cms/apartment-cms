<?php

namespace Graemekilkenny\ApartmentCMS\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // [ 'name', 'template_id', 'parent_id', 'sort_order' ]
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
        $page = $this->where('slug', $slug)->first();

        if( ! $page ){
            return abort(404);
        }

        return $page;
    }

    public function navigation()
    {
        return $this->where('parent_id', 0)->get()->sortBy('sort_order');
    }

}
