<?php

/*
 * This file is part of the ArtesanusBundle package.
 *
 * (c) Cristian Angulo <cristianangulonova@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArtesanIO\ArtesanusBundle\Model;


interface ModelManagerInterface
{
    public function getRepository();

    public function getDispatcher();

    public function save($model, $flush= true);

    public function delete($model, $flush = true);

    public function reload($model);

    public function isDebug();
}
