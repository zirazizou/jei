<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/29/2018
 * Time: 12:07 PM
 */

namespace OC\PlatformBundle\Datafixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Skill;

class LoadSkill extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = array('PHP', 'Symfony', 'C++', 'Java', 'Photoshop', 'Blender', 'Bloc-note');

        foreach ($names as $value){
            $skill = new Skill();
            $skill->setName($value);
            $manager->persist($skill);
        }
        $manager->flush();

    }

}