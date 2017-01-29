<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;

use ApartmentCMS\ApartmentCMS\Models\Page;
use ApartmentCMS\ApartmentCMS\Models\Template;

class PageRepository implements PageRepositoryInterface {

	protected $page;
	protected $template;
	protected $modelNamespace = 'ApartmentCMS\ApartmentCMS\Models';

	public function __construct(Page $page, Template $template)
	{
		$this->page = $page;
		$this->template = $template;
	}

	public function getAll()
	{
		return $this->page->all();
	}

	public function getEmpty()
	{
		return $this->page;
	}

	public function saveNewPage($request)
	{
		/**
         * Insert new page model
         */
        $this->page->name = $request->name;
        $this->page->slug = $request->slug;
        $this->page->template_id = $request->template;
        $this->page->save();

        /**
         * Insert blank template record
         */
        $class = $this->getTemplateClass($this->page->template_id);
        $class->createNewRecord($this->page, $request);
	}

	public function updatePage($request, $slug)
	{
		/**
         * Get data for page to be edited
         */
        $page = $this->findBySlug($slug);

        /**
         * Get the template data
         */
        $class = $this->getTemplateClass($page->template_id);
        //var_dump($page);
        list($templateData, $model) = $this->getTemplateSpecificData($page, $class);

        /**
         * Update page model
         */
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->template_id = $request->template;
        $page->save();

        /**
         * Update template instance
         */
        $templateData->content = $request->content;
        $templateData->save();
	}

    public function findBySlug($slug)
    {
        $page = $this->page->where('slug', $slug)->first();

        if( ! $page ){
            return abort(404);
        }

        return $page;
    }

    /**
     * Get the template class for a specific page
     */
	public function getTemplateClass($templateId)
	{
		/**
         * Find the template
         */
        $this->template = $this->template->find($templateId);
        
        /**
         * Instantiate relavant template class and return fresh object
         */
        $class = $this->modelNamespace.'\\'.$this->template->model;
        
        if( ! class_exists($class) )
        {
            $class = 'App\\'.$this->template->model;
        }
        
        $template = new $class;

        return $template;
	}

	/**
     * Extract data from template table
     */
    public function getTemplateSpecificData($page, $class = null)
    {
        /**
         * Find the template
         */
        $this->template = $this->template->find($page->template_id);
        $modelName = $this->template->model;

        /**
         * If no template class, then find the class
         */
        if( ! $class )
        {
            $modelName = $this->modelNamespace.'\\'.$this->template->model;
        
            if( ! class_exists($modelName) )
            {
                $modelName = 'App\\'.$this->template->model;
            }
            
            $class = new $modelName;
        }
        
        /**
         * Extract template specific data for this page
         */
        $templateData = $class->findByPageId($page->id);

        return [$templateData, $this->template->model];
    }
}