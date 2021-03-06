<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;
 
interface BucketRepositoryInterface
{
	public function getAll();
	public function getEmpty();	
	public function saveNew($request);
	public function update($request, $slug);
	public function findBySlug($slug);
}