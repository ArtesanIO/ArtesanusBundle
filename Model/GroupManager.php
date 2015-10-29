<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

class GroupManager
{
    protected $em;
    protected $class;
    protected $repository;
    protected $sluger;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function getClass()
    {
        return new $this->class('');
    }

    public function save($model)
    {
        $this->_save($model);
    }

    protected function _save($model)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

}



?>
