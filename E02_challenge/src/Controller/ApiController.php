<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\BirdModel;

class ApiController extends AbstractController
{
    public function index()
    {
        return $this->json(BirdModel::getBirds());
    }

    public function detail($id)
    {
        $birds = BirdModel::getBirds();

        if (array_key_exists($id, $birds)) {
            return $this->json($birds[$id]);
        } else  {
            throw $this->createNotFoundException();
        }
    }
}
