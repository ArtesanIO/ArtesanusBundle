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

use ArtesanIO\ArtesanusBundle\ArtesanusEvents;
use ArtesanIO\ArtesanusBundle\Event\ModelEvent;
use ArtesanIO\ArtesanusBundle\Model\ModelManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

abstract class ModelManager extends ContainerAware implements ModelManagerInterface
{
    protected $class;

    /**
     * Constructor.
     *
     * @param EntityManager  $em
     * @param string   $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->class = $class;
    }

    public function em()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    private function getEventPrefix()
    {
        $prefix = explode('\\', $this->class);

        return strtolower(array_pop($prefix));
    }

    public function getRepository()
    {
        return $this->em()->getRepository($this->class);
    }

    protected function get($id)
    {
        return $this->container->get($id);
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
    public function save($model, $flush = true)
    {
        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_before_save.event', new ModelEvent($model, $this->container));

        $this->persist($model, $flush, array('style' => 'warning', 'msn' =>$this->getFlashCreate()));

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_after_save.event', new ModelEvent($model, $this->container));

        return $model;
    }

    public function update($model, $flush = true)
    {
        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_before_update.event', new ModelEvent($model, $this->container));

        $this->persist($model, $flush, array('style' => 'info', 'msn' =>$this->getFlashUpdate()));

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_after_update.event', new ModelEvent($model, $this->container));

        return $model;
    }

    /**
     *	This is basic save function. Child model can overwrite this.
     */
    protected function persist($model, $flush = true, $flash = array()) {
        $this->em()->persist($model);
        if ($flush) {
            $this->em()->flush();

            if($flash){
                $this->container->get("session")->getFlashBag()->add($flash['style'], $flash['msn']);
            }
        }
    }
    /**
     * Delete a model.
     *
     * @param BaseModel $model
     */
    public function delete($model, $flush = true) {

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_before_delete.event', new ModelEvent($model, $this->getContainer()));

        $this->remove($model, $flush);

        $this->getDispatcher()->dispatch($this->getEventPrefix() . '.model_after_delete.event', new ModelEvent($model, $this->getContainer()));
    }
    /**
     * Remove model.
     */
    public function remove($model, $flush = true) {
        $this->em()->remove($model);
        if ($flush) {
            $this->em()->flush();
            $this->container->get("session")->getFlashBag()->add('danger', $this->getFlashRemove());
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
    public function getClass()
    {
        return $this->class;
    }

    public function isDebug()
    {
        return $this->get('kernel')->isDebug();
    }

    public function getFlashCreate()
    {
        return $this->container->get('translator')->trans('artesanus.msn_flash.created', array(), 'ArtesanusBundle');
    }

    public function getFlashUpdate()
    {
        return $this->container->get('translator')->trans('artesanus.msn_flash.update', array(), 'ArtesanusBundle');
    }

    public function getFlashRemove()
    {
        return $this->container->get('translator')->trans('artesanus.msn_flash.removed', array(), 'ArtesanusBundle');
    }

}
