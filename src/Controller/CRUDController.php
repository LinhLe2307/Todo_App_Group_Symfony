<?php

namespace App\Controller;


use App\Entity\TodoList;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create', name: 'create_task', methods: ['POST'])]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $title = trim($request->get('title'));
        if(!empty($title)) {
            $entityManager = $doctrine->getManager();
            $todo = new TodoList();
            $todo->setTitle($title);
            $entityManager->persist($todo);
            $entityManager->flush();
            return new Response("task added");
        } else {
            return $this->redirectToRoute('app_homepage');
        }
    }
}
