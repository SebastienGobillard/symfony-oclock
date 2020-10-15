<?php

namespace App\Controller;

use App\Model\BirdModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BirdController extends AbstractController
{
    public function index(SessionInterface $session)
    {
        $birds = BirdModel::getBirds();

        $lastSeenBird = $session->get('lastSeenBird');
        return $this->render('bird/index.html.twig', [
            'birds' => $birds,
            'lastSeenBird' => $lastSeenBird
        ]);
    }

    public function detail($id, SessionInterface $session)
    {
        $birds = BirdModel::getBirds();

        if (!array_key_exists($id, $birds)) {
            throw $this->createNotFoundException('This bird does not exist');
        }
        $bird = $birds[$id];
        $session->set('lastSeenBird', $bird);
        return $this->render('bird/detail.html.twig', ['bird' => $bird]);
    }

    public function pdf()
    {
        return $this->file(
            'Comprendre Informatique Quantique Olivier Ezratty.pdf',
            null,
            ResponseHeaderBag::DISPOSITION_INLINE
        );
    }
}
