<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;
 
interface PageRepositoryInterface 
{
	public function getAll();
	public function getEmpty();	
	public function saveNewPage($request);
	public function updatePage($request, $slug);
	public function findBySlug($slug);
	public function getTemplateClass($templateId);
	public function getTemplateSpecificData($page, $class = null);
}