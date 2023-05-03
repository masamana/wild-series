<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig');
    }

    #[Route('/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(int $id): Response
    {
        if (!$id) {
            throw $this->createNotFoundException('Error 404');
            // the above is just a shortcut for:
            // throw new NotFoundHttpException('The product does not exist');
        }
        return $this->render('program/show.html.twig', ['id' => $id]);
    }
}
