<?php

namespace ApartmentCMS\ApartmentCMS\Models;

use Illuminate\Database\Eloquent\Model;

use ApartmentCMS\ApartmentCMS\Models\Template;

class Blog extends Template
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'template_blog';

    /**
     * The buckets for this template
     */
    protected $buckets = [
        'blog'
    ];
}
