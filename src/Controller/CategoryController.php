<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    #[Route('/{name}', methods: ['GET'], name: 'show')]
    public function show(string $name, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $name]);
        if (!$category) {
            throw $this->createNotFoundException(
                'Error 404 / ' . 'Acune catégorie nommée ' . $name
            );
        }

        $programs = $category->getPrograms();

        $latestPrograms = $entityManager->createQueryBuilder()
            ->select('p')
            ->from('App\Entity\Program', 'p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        return $this->render('category/show.html.twig', ['category' => $category, 'programs' => $latestPrograms]);
    }
}
