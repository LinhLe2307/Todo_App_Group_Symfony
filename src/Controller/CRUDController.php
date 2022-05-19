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
            return $this->redirectToRoute('app_homepage');
        } else {
            return $this->redirectToRoute('app_homepage');
        }
    }

    #[Route('/update/{id}', name: 'update_task')]
    public function update($id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager(); // saving in the database
        $todo = $entityManager->getRepository(TodoList::class)->find($id); //find a specific record by id from the database 
        $todo->setStatus(!$todo->getStatus()); //
        $entityManager->flush(); // save a todo in the db by flush method
        return $this->redirectToRoute('app_homepage'); //redirect to the homepage
    }

    #[Route('/delete/{id}', name: 'delete_task')]
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $id = $entityManager->getRepository(TodoList::class)->find($id);
        $entityManager->remove($id);
        $entityManager->flush();
        return $this->redirectToRoute('app_homepage');
    }
}
