<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Review;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog.index")
     */
    public function index(PostRepository $repository)
    {
        $posts = $repository->findAll();

        dump($posts);

        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/{id}", name="blog.show")
     */
    public function show(Post $post = null, Request $request)
    {
        if (!$post) {
            $this->createNotFoundException('This post does not exist or has been deleted.');
        }

        if ($request->isMethod('POST')) {
            $review = new Review();

            $review
                ->setUsername($request->request->get('username'))
                ->setBody($request->request->get('body'))
                ->setPost($post);

            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('blog.show', ['id' => $post->getId()]);
        }

        return $this->render('blog/show.html.twig', [
            'post' => $post,
        ]);
    }
}