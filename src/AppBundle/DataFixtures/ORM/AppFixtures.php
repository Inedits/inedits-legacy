<?php
// src/AppBundle/DataFixtures/ORM/LoadData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = \Nelmio\Alice\Fixtures::load(__DIR__.'/user.yml', $manager);
        $objects = \Nelmio\Alice\Fixtures::load(__DIR__.'/post.yml', $manager);
    }
}
