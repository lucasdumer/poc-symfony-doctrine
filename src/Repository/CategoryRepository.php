<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function create(string $name): Category
    {
        try {
            $category = new Category();
            $category->setName($name);
            $this->em->persist($category);
            $this->em->flush();
            return $category;
        } catch (\Exception $e) {
            throw new \Exception("Error on creating category. ".$e->getMessage());
        }
    }

    public function findById(int $id): Category
    {
        try {
            $category = $this->em->find('App\Entity\Category', $id);
            if (!$category) {
                throw new \Exception("Dont find category with id: ".$id);
            }
            return $category;
        } catch (\Exception $e) {
            throw new \Exception("Error on find category. ".$e->getMessage());
        }
    }

    public function update(int $id, string $name): Category
    {
        try {
            $category = $this->findById($id);
            $category->setName($name);
            $this->em->persist($category);
            $this->em->flush();
            return $category;
        } catch (\Exception $e) {
            throw new \Exception("Error on update category. ".$e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $category = $this->findById($id);
            $this->em->remove($category);
            $this->em->flush();
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Error on delete category. ".$e->getMessage());
        }
    }

    public function list(): array
    {
        try {
            $query = $this->em->createQuery("select c from App\Entity\Category c");
            return array_map(function (Category $category) {
                return [
                    "id" => $category->getId(),
                    "name" => $category->getName(),
                ];
            }, $query->getResult());
        } catch (\Exception $e) {
            throw new \Exception("Error on list category. ".$e->getMessage());
        }
    }
}