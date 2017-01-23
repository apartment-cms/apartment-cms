<?php 

namespace ApartmentCMS\ApartmentCMS\Controllers\Cms;
 
use App\Http\Controllers\Controller;

use ApartmentCMS\ApartmentCMS\Models\Page;
use ApartmentCMS\ApartmentCMS\Models\Template;
use ApartmentCMS\ApartmentCMS\Models\Bucket;
use ApartmentCMS\ApartmentCMS\Models\DataItem;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends Controller
{
    protected $page;
    protected $template;
    protected $bucket;
    protected $dataItem;
    protected $modelNamespace = 'ApartmentCMS\ApartmentCMS\Models';

    public function __construct(Page $page, Template $template, Bucket $bucket, DataItem $dataItem)
    {
        $this->page = $page;
        $this->template = $template;
        $this->bucket = $bucket;
        $this->dataItem = $dataItem;
    }

    public function home()
    {
        $this->page->name = 'CMS Home';

        /**
         * Return the view for the CMS homepage
         */
        return view('apartment-cms::cms.pages.home')->with([
            'pages'      => $this->page,
            'buckets'    => $this->bucket
        ]);
    }

    public function edit($slug)
    {
        $pages = $this->page;
        $this->page = $this->page->findBySlug($slug);
        
        /**
         * Find the template
         */
        $this->template = $this->template->find($this->page->template_id);

        /**
         * Extract data from template table
         */
        $class = $this->modelNamespace.'\\'.$this->template->model;
        $viewName = strtolower($this->template->model);

        if( ! class_exists($class) )
        {
            $class = 'App\\'.$this->template->model;
        }
        
        $templateData = new $class;   
        $templateData = $templateData->findByPageId($this->page->id);

        /**
         * Return the edit form for this page
         */
        return view('apartment-cms::cms.pages.edit')->with([
            'pages'     => $pages,
            'page'      => $this->page,
            'buckets'   => $this->bucket,
            'template'  => $templateData
        ]);
    }
}