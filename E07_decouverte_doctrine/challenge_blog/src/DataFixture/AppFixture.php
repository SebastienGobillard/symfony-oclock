<?php

namespace App\DataFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Post;

class AppFixture extends Fixture
{
    public function load(ObjectManager $om)
    {
        for ($i = 0; $i < 15; $i++) {
            $post = new Post();
            $post->setTitle('Post n°' . $i)
                ->setBody('Lorem ipsum dolor sit amet laborum')
                ->setUpdatedAt(new \DateTime())
                ->setNbLikes(rand(0, 142));
            $om->persist($post);
        }
        $om->flush();
    }
}