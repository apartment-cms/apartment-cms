<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;

use ApartmentCMS\ApartmentCMS\Models\Bucket;
//use ApartmentCMS\ApartmentCMS\Models\Template;

class BucketRepository implements BucketRepositoryInterface {

	protected $bucket;
	protected $modelNamespace = 'ApartmentCMS\ApartmentCMS\Models';

	public function __construct(Bucket $bucket)
	{
		$this->bucket = $bucket;
	}

	public function getAll()
	{
		return $this->bucket->all();
	}

	public function getEmpty()
	{
		return $this->bucket;
	}

	/**
     * Insert new bucket model
     */
	public function saveNew($request)
	{
		$this->bucket->name = $request->name;
        $this->bucket->slug = $request->slug;
        $this->bucket->save();

        // /**
        //  * Insert blank template record
        //  */
        // $class = $this->getTemplateClass($this->page->template_id);
        // $class->createNewRecord($this->page, $request);
	}

	public function update($request, $slug)
	{
		/**
         * Get data for page to be edited
         */
        $bucket = $this->findBySlug($slug);

        /**
         * Get the template data
         */
        // $class = $this->getTemplateClass($page->template_id);
        // list($templateData, $model) = $this->getTemplateSpecificData($page, $class);

        /**
         * Update page model
         */
        $bucket->name = $request->name;
        $bucket->slug = $request->slug;
        $bucket->save();

        /**
         * Update template instance
         */
        // $templateData->content = $request->content;
        // $templateData->save();
	}

	public function findBySlug($slug){
		$bucket = $this->bucket->where('slug', $slug)->first();

        if( ! $bucket ){
            return abort(404);
        }

        return $bucket;
	}
}