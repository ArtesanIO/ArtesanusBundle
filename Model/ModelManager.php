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

use ArtesanIO\ArtesanusBundle\Event\ModelEvent;
use ArtesanIO\ArtesanusBundle\Model\ModelManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class ModelManager extends ContainerAware implements ModelManagerInterface
{
    protected $class;

    /**
     * Constructor.
     *
     * @param EntityManager  $em
     * @param string   $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    protected function get($id)
    {
        return $this->container->get($id);
    }

    public function em()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    public function getRepository()
    {
        return $this->em()->getRepository($this->class);
    }

    public function entityPrefix()
    {
        $prefix = explode('\\', $this->class);

        return strtolower(end($prefix));
    }

    public function getDispatcher() {
        return $this->get('event_dispatcher');
    }

    /**
     * Create model object
     *
     * @return BaseModel
     */
    public function create() {

        $class = $this->em()->getClassMetadata($this->class);

        return new $class->name;

    }
    /**
     * Persist the model
     *
     * @param $model
     * @param boolean $flush
     * @return BaseModel
     */
    public function save($model, $flush = true)
    {
        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_before_save.event', new ModelEvent($model, $this->container));

        $this->persist($model, $flush);

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_after_save.event', new ModelEvent($model, $this->container));

        return $model;
    }

    /**
     *	This is basic save function. Child model can overwrite this.
     */
    protected function persist($model, $flush = true, $flash = array()) {
        $this->em()->persist($model);
        if ($flush) {
            $this->em()->flush();
        }
    }
    /**
     * Delete a model.
     *
     * @param BaseModel $model
     */
    public function delete($model, $flush = true) {

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_before_delete.event', new ModelEvent($model, $this->container));

        $this->remove($model, $flush);

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_after_delete.event', new ModelEvent($model, $this->container));
    }
    /**
     * Remove model.
     */
    public function remove($model, $flush = true) {
        $this->em()->remove($model);
        if ($flush) {
            $this->em()->flush();
        }
    }
    /**
     * Reload the model data.
     */
    public function reload($model) {
        $this->em->refresh($model);
    }

    public function isDebug()
    {
        return $this->get('kernel')->isDebug();
    }

    public function redirectTo($request, $parameters = array(), $status = 302)
    {
        $action = $this->entityPrefix().'_edit';

        if($request->request->get('close')){
            $action = $this->entityPrefix();
            $parameters = array();
        }

        return new RedirectResponse($this->container->get('router')->generate($action, $parameters), $status);
    }

    public function tableFields()
    {
        return array('id');
    }
}
