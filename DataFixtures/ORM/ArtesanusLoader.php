<?php

namespace ArtesanIO\ArtesanusBundle\DataFixtures\ORM\Dev;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class ArtesanusLoader extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__.'/artesanus.yml'
        ];
    }

    public function characterName()
    {
        $names = [
            'Cristian',
            'Dulce',
            'Emmanuel',
            'David',
            'Ivanna',
            'Regina'
        ];

        return $names[array_rand($names)];
    }
}
