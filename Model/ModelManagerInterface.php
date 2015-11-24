<?php

namespace ArtesanIO\ArtesanusBundle\Model;


interface ModelManagerInterface
{

    public function setContainer($container);

    public function getContainer();

    public function getDispatcher();

    public function create();

    public function save($model, $flush= true);

    public function delete($model, $flush = true);

    public function reload($model);

    public function getClass();

    public function findOneBy($array = array());

    public function findAll();

    public function isDebug();
}
