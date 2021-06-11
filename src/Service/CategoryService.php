<?php

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use App\Command\CategoryCreateCommand;

class CategoryService
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function create(CategoryCreateCommand $categoryCreateCommand): Category
    {
        try {
            $category = new Category();
            $category->setName($categoryCreateCommand->getName());
            $this->em->persist($category);
            $this->em->flush();
            return $category;
        } catch (\Exception $e) {
            throw new \Exception("Service error on creating category. ".$e->getMessage());
        }
    }
}