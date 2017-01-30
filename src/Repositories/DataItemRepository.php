<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;

use ApartmentCMS\ApartmentCMS\Models\DataItem;
//use ApartmentCMS\ApartmentCMS\Models\Template;

class DataItemRepository implements DataItemRepositoryInterface {

	protected $dataItem;
	protected $modelNamespace = 'ApartmentCMS\ApartmentCMS\Models';

	public function __construct(DataItem $dataItem)
	{
		$this->dataItem = $dataItem;
	}

	public function list($bucketId)
	{
		return $this->dataItem->where('bucket_id', $bucketId)->get();
	}

	/**
     * Insert new dataItem model
     */
	public function saveNew($request)
	{
		$this->dataItem->name = $request->name;
        $this->dataItem->slug = $request->slug;
        $this->dataItem->content = $request->content;
        $this->dataItem->bucket_id = $request->bucket_id;
        $this->dataItem->save();
	}

	public function update($request, $slug)
	{
		/**
         * Get data for page to be edited
         */
        $item = $this->findBySlug($slug);

        /**
         * Get the template data
         */
        // $class = $this->getTemplateClass($page->template_id);
        // list($templateData, $model) = $this->getTemplateSpecificData($page, $class);

        /**
         * Update page model
         */
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->content = $request->content;
        $item->save();

        /**
         * Update template instance
         */
        // $templateData->content = $request->content;
        // $templateData->save();
	}

	public function findBySlug($slug){
		$dataItem = $this->dataItem->where('slug', $slug)->first();

        if( ! $dataItem ){
            return abort(404);
        }

        return $dataItem;
	}
}