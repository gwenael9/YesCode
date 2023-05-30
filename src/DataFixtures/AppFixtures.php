<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) {

        $faker = Factory::create("fr_FR");

        $users = [];
        $genres = ['male', 'female'];

        // Gestion de nos utilisateurs
        for ($i=0; $i <= 20 ; $i++) { 

            $user = new User();

            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $picturesId = $faker->numberBetween(1,99) . '.jpg';

            $picture .= ($genre == 'male' ? 'men/' : 'women/') . $picturesId;

            $user->setFirstname($faker->firstname($genre))
                 ->setLastname($faker->lastname)
                 ->setEmail($faker->email)
                 ->setAvatar($picture)
                 ->setPresentation($faker->word(155))
                 ->setHash($this->encoder->hashPassword($user, "password"));

            $manager->persist($user);
            $users[] = $user;
        }

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

            // mathrandom qui donne un chiffre de 0 a maxUser-1
            $author = $users[mt_rand(0, count($users) -1)];

            $article->setTitle($title)
                    ->setIntro($intro)
                    ->setContent($content)
                    ->setImage($image)
                    ->setAuthor($author);
 
            $manager->persist($article);
        }

        $manager->flush();
    } 
}
