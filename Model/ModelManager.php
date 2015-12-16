<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\ArtesanusEvents;
use ArtesanIO\ArtesanusBundle\Event\ModelEvent;
use ArtesanIO\ArtesanusBundle\Model\ModelManagerInterface;
use Doctrine\ORM\EntityManager;

abstract class ModelManager implements ModelManagerInterface
{

    protected $em;
    protected $class;
    protected $repository;
    protected $container;

    /**
     * Constructor.
     *
     * @param EntityManager  $em
     * @param string   $class
     */
    public function __construct(EntityManager $em, $class) {

        $this->em = $em;
        $this->repository = $this->em->getRepository($class);
        $metadata = $this->em->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    private function getEventPrefix()
    {
        $prefix = explode('\\', $this->class);

        return strtolower(array_pop($prefix));
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function setContainer($container) {
        $this->container = $container;
    }
    public function getContainer() {
        return $this->container;
    }
    public function getDispatcher() {
        return $this->getContainer()->get('event_dispatcher');
    }
    /**
     * Create model object
     *
     * @return BaseModel
     */
    public function create() {
        $class = $this->getClass();
        return new $class;
    }
    /**
     * Persist the model
     *
     * @param $model
     * @param boolean $flush
     * @return BaseModel
     */
    public function save($model, $flush= true)
    {
        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_before_save.event', new ModelEvent($model, $this->getContainer()));

        $this->_save($model, $flush);

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_after_save.event', new ModelEvent($model, $this->getContainer()));

        return $model;
    }
    /**
     *	This is basic save function. Child model can overwrite this.
     */
    protected function _save($model, $flush=true) {
        $this->em->persist($model);
        if ($flush) {
            $this->em->flush();
        }
    }
    /**
     * Delete a model.
     *
     * @param BaseModel $model
     */
    public function delete($model, $flush = true) {

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_before_delete.event', new ModelEvent($model, $this->getContainer()));

        $this->_delete($model, $flush);

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_after_delete.event', new ModelEvent($model, $this->getContainer()));
    }
    /**
     * Remove model.
     */
    public function _delete($model, $flush = true) {
        $this->em->remove($model);
        if ($flush) {
            $this->em->flush();
        }
    }
    /**
     * Reload the model data.
     */
    public function reload($model) {
        $this->em->refresh($model);
    }
    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass() {
        return $this->class;
    }

    public function isDebug() {
        return $this->container->get('kernel')->isDebug();
    }
}
