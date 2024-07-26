<?php

namespace App\Repositories;

interface PostsInterface
{
    public function getPaginated($featuredPost, $featureds, $limit = 6);

    public function getRelated($id, $limit = 3);

    public function getFeatureds($id, $limit = 2);

    public function findById($id);

    public function featuredPost();
}
