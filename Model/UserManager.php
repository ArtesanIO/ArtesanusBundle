<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;
use ArtesanIO\ArtesanusBundle\Utils\Encoder;
use Doctrine\ORM\EntityManager;

class UserManager extends ModelManager
{
    protected $em;
    protected $class;
    protected $repository;
    protected $encoder;

    public function __construct(EntityManager $em, $class, Encoder $encoder)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->encoder = $encoder;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneByEmail($email)
    {
        return $this->repository->findOneByEmail($email);
    }

    public function usernameOREmail($username)
    {
        return $this->repository->findUsernameOREmail($username);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function create()
    {
        $class = $this->getClass();
        return new $class;
    }

    public function save($model, $flus = true)
    {
        $model->setPassword($this->encoder->setUserPassword($model, $model->getPassword()));
        $this->_save($model);
    }

    protected function _save($model, $flus = true)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

    public function updatePassword($model, $dataForm)
    {
        $data = $dataForm->getData();
        $model->setPassword($this->encoder->setUserPassword($model, $data->getPassword()));
        $this->_save($model);
    }

}



?>
