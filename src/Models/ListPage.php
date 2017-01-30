<?php

namespace ApartmentCMS\ApartmentCMS\Models;

use Illuminate\Database\Eloquent\Model;

use ApartmentCMS\ApartmentCMS\Models\Template;

class ListPage extends Template
{
    protected $fields = [
        [
            'form_label' => 'content',
            'model_label' => 'content'
        ],
        [
            'form_label' => 'bucket',
            'model_label' => 'bucket_id'
        ]
    ];

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

    public function bucket()
    {
        return $this->belongsTo('ApartmentCMS\ApartmentCMS\Models\Bucket');
    }
}
