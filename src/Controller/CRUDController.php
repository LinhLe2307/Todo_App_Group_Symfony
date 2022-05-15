<?php

namespace App\Controller;


use App\Entity\TodoList;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRUDController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(EntityManagerInterface $em): Response
    {   
        $tasks = $em->getRepository(TodoList::class)->findBy([], ['id' => 'DESC']);
        return $this->render('crud/index.html.twig', [
            'tasks' => $tasks
        ]);
    }
}
