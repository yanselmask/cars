<?php

namespace App\Repositories;


interface ListingInterface
{
    public function getPaginated($limit = 8);

    public function getShortsPaginated($limit = 12);

    public function getFavorites($limit = 6);

    public function getCompares();

    public function getRelated($id, $limit = 6);

    public function getPaginateForVendor($userId, $limit = 6);

    public function makemodelsJson($make);

    public function findById($id);
}
