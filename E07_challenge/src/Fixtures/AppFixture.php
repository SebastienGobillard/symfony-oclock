<?php

namespace App\Fixtures;

use App\Entity\Author;
use App\Entity\Post;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixture extends Fixture
{
    public function load(ObjectManager $om)
    {
        $startTime = microtime(true);
        $totalPost = 0;
        $totalReview = 0;

        $faker = Factory::create();

        $nbAuthor = rand(10, 20);
        for ($i = 0; $i < $nbAuthor; $i++) {
            $author = new Author();
            $author->setName($faker->name);
            $om->persist($author);

            $nbPost= rand(10, 20);
            for ($j = 0; $j < $nbPost; $j++) {
                $post = new Post();
                $post->setTitle($faker->sentence)
                    ->setBody($faker->paragraphs($nb = 3, $asText = true))
                    ->setImage($faker->imageUrl())
                    ->setAuthor($author);
                $om->persist($post);
                $totalPost++;

                $nbReview = rand(0,10);
                for ($k = 0; $k < $nbReview; $k++) {
                    $review = new Review();
                    $review->setUsername($faker->name)
                        ->setBody($faker->paragraph)
                        ->setPost($post);
                    $om->persist($review);
                    $totalReview++;
                }
            }
        }
        $om->flush();

        $endTime = microtime(true);
        $elapsedTime = round($endTime - $startTime, 3);

        echo "Created (in " . $elapsedTime . "s):\n"
            . "- " . $nbAuthor . " authors,\n"
            . "- " . $totalPost . " posts, \n"
            . "- " . $totalReview . " reviews,\n"
        ;
    }
}