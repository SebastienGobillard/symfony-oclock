<?php

namespace App\Controller;

use      App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route ("/", name="post.list")
     */
    public function list(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();

        return $this->render('post/list.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/post", name="post_index")
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();

        return $this->json($posts);
    }

    /**
     * @Route("/post/create", name="post_create")
     */
    public function create(EntityManagerInterface $em)
    {
        $newPost = new Post();

        $newPost
            ->setTitle('Lorem ipsum dolor')
            ->setBody('<p>Je suis un super post</p>')
            ->setUpdatedAt(new \DateTime())
            ->setNbLikes(rand(0, 142));

        $em->persist($newPost);
        $em->flush();

        return $this->redirectToRoute('post_read', [
            'id' => $newPost->getId()
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_read")
     */
    public function read($id, Post $post = null)
    {
        if (!$post) {
            throw $this->createNotFoundException('No post found for id ' . $id);
        }

        return $this->render('post/show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/post/{id}/update", name="post_update", methods={"GET", "POST"})
     */
    public function update(EntityManagerInterface $em, Request $request, Post $post = null)
    {
        if (!$post) {
            throw $this->createNotFoundException('No post found.');
        }

        if ($request->isMethod('POST')) {
            $post->setTitle($request->request->get('title'))
                ->setBody($request->request->get('body'))
                ->setNbLikes($request->request->get('nb-likes'));

            $em->flush();
            $this->addFlash('success', 'Le post '.$post->getTitle().' a été modifié.');

            return $this->redirectToRoute('post_read', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('post/update.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/post/{id}/delete", name="post_delete")
     */
    public function delete($id, EntityManagerInterface $em, Post $post = null)
    {
        if (!$post) {
            throw $this->createNotFoundException('No post found for id ' . $id);
        }

        $em->remove($post);
        $em->flush();
        $this->addFlash('success', 'Le post "'.$post->getTitle().'" a été supprimé.');

        return $this->redirectToRoute('post.list');
    }
}
