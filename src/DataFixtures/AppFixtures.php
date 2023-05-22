<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager) {

        $faker = Factory::create();

        for ($i=1; $i <= 20 ; $i++) { 

            $article = new Article();

            $title = $faker->sentence(2);
            $image = "https://picsum.photos/400/300";            
            $intro = $faker->paragraph(2);
            $content = "<p>". implode("</p><p>",$faker->paragraphs(5)) . "</p>";
            $createdAt = $faker->dateTimeBetween('-2 months');

            $article->setTitle($title)
                    ->setIntro($intro)
                    ->setContent($content)
                    ->setImage($image)
                    ->setCreatedAt($createdAt);
 
            $manager->persist($article);
        }
            
        $manager->flush();
    } 
}
