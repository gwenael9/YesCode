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

        // Gestion de nos articles
        // pour modifier qlq chose, on doit finir par faire : php bin/console doctrine:fixtures:load
        for ($i=1; $i <= 15 ; $i++) { 

            $article = new Article();

            $title = $faker->sentence(1);
            $image = "https://picsum.photos/400/300";       
            // $url = "https://picsum.photos/id/".static::randomNumber(2)."/{$width}/{$height}/";    
            $intro = $faker->sentence(3);
            $content = "<p>". implode("</p><p>",$faker->paragraphs(5)) . "</p>";
            // $createdAt = $faker->dateTimeBetween('-2 months');

            $article->setTitle($title)
                    ->setIntro($intro)
                    ->setContent($content)
                    ->setImage($image);
 
            $manager->persist($article);
        }
            
        $manager->flush();
    } 
}
