<?php

namespace App\DataFixtures;

use App\Entity\Diet;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

   
    public function  __construct()
    {
        $this->faker = Factory::create('fr_FR');
        
    }
    public function load(ObjectManager $manager): void
    {
        //Ingredients
        $ingredients = [];
        for ($i = 0; $i < 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setIsAllergen(mt_rand(0, 1) == 1 ? true : false);

            $ingredients[] = $ingredient;
            $manager->persist($ingredient);

        }
    

        //Diets
        $diets = [];
        for ($n = 0; $n < 20; $n++) {
        $diet = new Diet();
        $diet->setName($this->faker->word());
       
        $diets[] = $diet;
        $manager->persist($diet);
        }

        //Recipes
        $recipes = [];
        for ($j = 0; $j < 25; $j++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->word())
                ->setDescription($this->faker->text(300))
                ->setPreparationTime(mt_rand(1, 1440))
                ->setPauseTime(mt_rand(1, 1440))
                ->setCookingTime(mt_rand(1, 1440));
                    
        for ($k = 0; $k < mt_rand(5, 15); $k++) {
                $recipe->addIngredient($ingredients[mt_rand(0, count($ingredients) - 1)]);
            }

            $recipe->setSteps($this->faker->text(300));


        for ($g = 0; $g<mt_rand(0, 5); $g++) {
            $recipe->addDiet($diets[mt_rand(0, count($diets) - 1)]);
        }
        $recipes[] = $recipe;
    $manager->persist($recipe);
        }
        // Users
        $users = [];
        for ($j = 0; $j < 20; $j++) {
            $user = new User();
            $user->setFullName($this->faker->name())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password')
                ->setAllergies($this->faker->words(3))
                ->setDiets($this->faker->words(3));
                
                $users[] = $user;

            $manager->persist($user);
        }
        $manager->flush();
    }
}
