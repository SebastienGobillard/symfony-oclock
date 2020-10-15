<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Model\TodoModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends AbstractController
{
    public function index(Request $request)
    {
        $todo = new Todo();

        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash('success', 'Votre tache "' . $todo->getTask() . '" a bien été créé.');
            return $this->redirectToRoute('todo_index');
        }

        $todos = $this->getDoctrine()->getRepository(Todo::class)->findAll();

        return $this->render('todo/index.html.twig', [
            'todos' => $todos,
            'form' => $form->createView(),
        ]);
    }

    public function about()
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);

        return $this->render('todo/about.html.twig', ['form' => $form->createView()]);
    }

    public function show($id)
    {
        $task = TodoModel::find($id);

        if (!$task) {
            throw $this->createNotFoundException('La tâche n\'existe pas.');
        }
        return $this->render('todo/show.html.twig', [
            'task' => $task,
        ]);
    }

    public function delete($id)
    {
        $task = TodoModel::find($id);

        if (!$task) {
            throw $this->createNotFoundException('La tâche n\'existe pas.');
        }
        TodoModel::delete($id);
        $this->addFlash('success', 'La tâche a bien été supprimée.');
        return $this->redirectToRoute('todo_index');
    }

    public function setStatus($id, $status)
    {
        $success = TodoModel::setStatus($id, $status);

        if (!$success) {
            throw $this->addFlash('error', 'La tâche n\'existe pas');
        }
        $this->addFlash('success', 'Le status de la tâche a bien été modifiée');
        return $this->redirectToRoute('todo_index');
    }
}
