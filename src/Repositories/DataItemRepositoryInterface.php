<?php
namespace ApartmentCMS\ApartmentCMS\Repositories;
 
interface DataItemRepositoryInterface
{
	//public function getAll();
	//public function getEmpty();
	public function list($bucketId);
	public function saveNew($request);
	public function update($request, $slug);
	public function findBySlug($slug);
}