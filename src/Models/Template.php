<?php

namespace ApartmentCMS\ApartmentCMS\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
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

    public function findByPageId($pageId)
    {
        $page = $this->where('page_id', $pageId)->first();

        // if( ! $page ){
        //     return abort(404);
        // }

        return $page;
    }

    public function createNewRecord($page, $request)
    {
        $this->page_id = $page->id;
        $this->save();
    }
}
