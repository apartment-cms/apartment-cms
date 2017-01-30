<?php 

namespace ApartmentCMS\ApartmentCMS\Controllers\Cms;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use ApartmentCMS\ApartmentCMS\Repositories\PageRepositoryInterface;
use ApartmentCMS\ApartmentCMS\Repositories\BucketRepositoryInterface;
use ApartmentCMS\ApartmentCMS\Models\Template;
use ApartmentCMS\ApartmentCMS\Models\Bucket;
use ApartmentCMS\ApartmentCMS\Models\DataItem;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends Controller
{
    protected $repo;
    protected $template;
    protected $bucket;
    protected $dataItem;
    protected $modelNamespace = 'ApartmentCMS\ApartmentCMS\Models';

    public function __construct(PageRepositoryInterface $repo, BucketRepositoryInterface $bucket, Template $template, DataItem $dataItem)
    {
        $this->repo = $repo;
        $this->template = $template;
        $this->bucket = $bucket;
        $this->dataItem = $dataItem;
    }

    public function home()
    {
        $this->repo->name = 'CMS Home';

        /**
         * Return the view for the CMS homepage
         */
        return view('apartment-cms::cms.pages.home')->with([
            'pages'      => $this->repo,
            'buckets'    => $this->bucket
        ]);
    }

    public function create()
    {
        $this->repo->name = 'Create Page';

        /**
         * Return the view for the CMS create page page
         */
        return view('apartment-cms::cms.pages.create')->with([
            'pages'      => $this->repo,
            'buckets'    => $this->bucket
        ]);
    }

    public function store(Request $request)
    {
        /**
         * Validate the request
         */
        // Validation....!

        /**
         * Save to repository
         */
        $this->repo->saveNewPage($request);

        /**
         * Return the edit form for this page to add template specific data
         */
        return redirect('admin/pages/'.$request->slug);
    }

    public function edit($slug)
    {
        /**
         * Get page list for the navigation etc
         */
        $pages = $this->repo->getEmpty();

        /**
         * Get page data for page to be edited
         */
        $page = $this->repo->findBySlug($slug);

        /**
         * Get the template specific data for page to be edited
         */
        list($templateData, $model) = $this->repo->getTemplateSpecificData($page);

        /**
         * Return the edit form for this page
         */
        return view('apartment-cms::cms.pages.edit')->with([
            'pages'         => $pages,
            'page'          => $page,
            'buckets'       => $this->bucket,
            'model'         => $model,
            'templateData'  => $templateData
        ]);
    }

    public function update(Request $request, $slug)
    {
        // Validation....!

        /**
         * Save to repository
         */
        $this->repo->updatePage($request, $slug);

        /**
         * Return the edit form for this page to add template specific data
         */
        return redirect('admin/pages/'.$request->slug);
    }

    /**
     * Extract data from template table
     */
    public function getTemplateSpecificData($page)
    {
        /**
         * Find the template
         */
        $this->template = $this->template->find($page->template_id);
        $modelName = $this->template->model;

        /**
         * Extract data from template table
         */
        $class = $this->modelNamespace.'\\'.$this->template->model;
        
        if( ! class_exists($class) )
        {
            $class = 'App\\'.$this->template->model;
        }
        
        $template = new $class;
        $templateData = $template->findByPageId($page->id);

        return [$templateData, $modelName];
    }
}