<?php

namespace App\DataFixtures;

use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

final class AppFixture extends Fixture
{
    private $faker;
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->faker = Factory::create("fr_FR");
        $this->manager = $manager;
    }

    public function load(ObjectManager $manager)
    {
        $generator = $this->faker;
        $populator = new Populator($generator, $manager);

        $populator->addEntity('App\Entity\Movie', 10, [
            'title' => function() use ($generator) { return $generator->catchPhrase(); },
        ]);
        $populator->addEntity('App\Entity\Genre', 10, [
            'name' => function() use ($generator) { return $this->faker->word; }
        ]);
        $populator->addEntity('App\Entity\Person', 50, [
            'name' => function () use ($generator) { return $generator->name; },
        ]);

        $entities = $populator->execute();
        $movies = $entities['App\Entity\Movie'];
        $genres = $entities['App\Entity\Genre'];
        $persons = $entities['App\Entity\Person'];

        foreach ($movies as $movie) {
            shuffle($genres);
            for ($i = 0; $i < 3; $i++) {
                $genres[$i]->addMovie($movie);
            }

            $castCount = rand(5, 20);
            for ($i = 0; $i < $castCount - 1; $i++) {
                shuffle($persons);

                $casting = new Casting();
                $casting->setRole($generator->word)
                    ->setMovie($movie)
                    ->setPerson($persons[0])
                    ->setCreditOrder($i);

                $manager->persist($casting);
            }
        }
        $manager->flush();
    }
}
