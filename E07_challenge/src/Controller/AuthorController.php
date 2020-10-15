<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author.index")
     */
    public function index(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findBy([], ['name' => 'ASC']);

        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/author/{id}", name="author.show")
     */
    public function show(Author $author)
    {
        return $this->render('author/show.html.twig', [
            'author' => $author,
        ]);
    }
}
