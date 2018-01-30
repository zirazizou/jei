<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/28/2018
 * Time: 2:19 PM
 */

namespace OC\PlatformBundle\Datafixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;

class LoadCategory extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Développement web',
            'Développement mobile',
            'Graphisme',
            'Intégration',
            'Réseau'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $category = new Category();
            $category->setName($name);

            // On la persiste
            $manager->persist($category);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }

}