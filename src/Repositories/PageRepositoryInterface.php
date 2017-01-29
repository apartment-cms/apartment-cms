<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;
 
interface PageRepositoryInterface {
	
	public function saveNewPage($request);
	public function getTemplateClass($templateId);
}