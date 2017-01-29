<?php 

namespace ApartmentCMS\ApartmentCMS\Controllers;
 
use App\Http\Controllers\Controller;

use ApartmentCMS\ApartmentCMS\Repositories\PageRepository;
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

    public function __construct(PageRepository $page, Template $template, Bucket $bucket, DataItem $dataItem)
    {
        $this->page = $page;
        $this->template = $template;
        $this->bucket = $bucket;
        $this->dataItem = $dataItem;
    }

    public function home()
    {
        /**
         * The homepage is a special case
         * Get page from db
         */
        return $this->show('home');
    }
 
    public function show($slug, $item = null)
    {
        /**
         * The slug can either relate to a page or a bucket list view
         * Check for buckets first, then return page
         */
        /*if( $this->bucket->findBySlug($slug) ){
            return $this->objectList($slug);
        }*/

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
         * Do we have an item to display? Is this single view?
         */
        if( $item )
        {
            /**
             * The slug determines which object to display
             */
            $this->dataItem = $this->dataItem->findBySlug($item);

            /**
             * Return page and template to view
             */
            return view('apartment-cms::templates.'.$viewName)->with([
                'page'      => $this->page,
                'template'  => $templateData,
                'item'     => $this->dataItem
            ]);
        }

        /**
         * Return page and template to view
         */
        return view('apartment-cms::templates.'.$viewName)->with([
            'page'      => $this->page,
            'template'  => $templateData
        ]);
    }

}