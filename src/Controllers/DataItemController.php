<?php 

namespace ApartmentCMS\ApartmentCMS\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use ApartmentCMS\ApartmentCMS\Repositories\PageRepositoryInterface;
use ApartmentCMS\ApartmentCMS\Repositories\DataItemRepositoryInterface;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class DataItemController extends Controller
{
	protected $pageRepo;
	protected $itemRepo;

	public function __construct(PageRepositoryInterface $pageRepo, DataItemRepositoryInterface $itemRepo)
	{
		$this->pageRepo = $pageRepo;
		$this->itemRepo = $itemRepo;
	}

	public function create()
	{
		$this->pageRepo->getEmpty();
		$this->pageRepo->name = 'New Data Item';

		$this->bucketRepo->getEmpty();

        /**
         * Return the view for the CMS create page page
         */
        return view('apartment-cms::cms.buckets.create')->with([
            'pages'      => $this->pageRepo,
            'buckets'    => $this->bucketRepo
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
        $this->bucketRepo->saveNew($request);

        /**
         * Return the edit form for this page to add template specific data
         */
        return redirect('admin/buckets/'.$request->slug);
	}

	public function edit($slug)
	{
		/**
         * Get generic data for the navigation etc
         */
        $pages = $this->pageRepo->getEmpty();
        $buckets = $this->bucketRepo;
        
        /**
         * Get page data for page to be edited
         */
        $bucket = $this->bucketRepo->findBySlug($slug);

        /**
         * Get the template specific data for page to be edited
         */
        //list($templateData, $model) = $this->repo->getTemplateSpecificData($page);

        /**
         * Return the edit form for this page
         */
        return view('apartment-cms::cms.buckets.edit')->with([
            'pages'         => $pages,
            'bucket'        => $bucket,
            'buckets'       => $buckets
            //'model'         => $model,
            //'templateData'  => $templateData
        ]);
	}

	public function update(Request $request, $slug)
    {
        // Validation....!

        /**
         * Save to repository
         */
        $this->bucketRepo->update($request, $slug);

        /**
         * Return the edit form for this page to add template specific data
         */
        return redirect('admin/buckets/'.$request->slug);
    }
}