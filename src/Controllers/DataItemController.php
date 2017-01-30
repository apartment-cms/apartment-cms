<?php 

namespace ApartmentCMS\ApartmentCMS\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use ApartmentCMS\ApartmentCMS\Repositories\PageRepositoryInterface;
use ApartmentCMS\ApartmentCMS\Repositories\BucketRepositoryInterface;
use ApartmentCMS\ApartmentCMS\Repositories\DataItemRepositoryInterface;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class DataItemController extends Controller
{
	protected $pageRepo;
    protected $bucketRepo;
	protected $itemRepo;

	public function __construct(PageRepositoryInterface $pageRepo, 
                                BucketRepositoryInterface $bucketRepo, 
                                DataItemRepositoryInterface $itemRepo)
	{
		$this->pageRepo = $pageRepo;
        $this->bucketRepo = $bucketRepo;
		$this->itemRepo = $itemRepo;
	}

	public function create($bucketId)
	{
		$this->pageRepo->getEmpty();
		$this->pageRepo->name = 'New Data Item';

		$bucket = $this->bucketRepo->findById($bucketId);

        /**
         * Return the view for the CMS create data item page
         */
        return view('apartment-cms::cms.dataitem.create')->with([
            'pages'      => $this->pageRepo,
            'buckets'    => $this->bucketRepo,
            'bucket'     => $bucket
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
        $this->itemRepo->saveNew($request);

        /**
         * Redirect to bucket edit page
         */
        $bucket = $this->bucketRepo->findById($request->bucket_id);

        /**
         * Return the edit form for this page to add template specific data
         */
        return redirect('admin/buckets/'.$bucket->slug);
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
        $item = $this->itemRepo->findBySlug($slug);

        /**
         * Get the template specific data for page to be edited
         */
        //list($templateData, $model) = $this->repo->getTemplateSpecificData($page);

        /**
         * Return the edit form for this page
         */
        return view('apartment-cms::cms.dataitem.edit')->with([
            'pages'         => $pages,
            'item'          => $item,
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
        $this->itemRepo->update($request, $slug);

        /**
         * Redirect to bucket edit page
         */
        $bucket = $this->bucketRepo->findById($request->bucket_id);

        return redirect('admin/buckets/'.$bucket->slug);
    }
}