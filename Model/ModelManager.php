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

    public function em()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    private function entityPrefix()
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
    public function save($model, $flush = true, $saveOrUpdate = false)
    {
        $saveOrUpdate = ($saveOrUpdate) ? 'update': 'save';

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_before_'.$saveOrUpdate.'.event', new ModelEvent($model, $this->container));

        $this->persist($model, $flush);

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_after_'.$saveOrUpdate.'.event', new ModelEvent($model, $this->container));

        return $model;
    }

    /**
     *	This is basic save function. Child model can overwrite this.
     */
    protected function persist($model, $flush = true, $flash = array()) {
        $this->em()->persist($model);
        if ($flush) {
            $this->em()->flush();
            $this->container->get("session")->getFlashBag()->add('info', $this->getFlashSave());
        }
    }
    /**
     * Delete a model.
     *
     * @param BaseModel $model
     */
    public function delete($model, $flush = true) {

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_before_delete.event', new ModelEvent($model, $this->getContainer()));

        $this->remove($model, $flush);

        $this->getDispatcher()->dispatch($this->entityPrefix() . '.model_after_delete.event', new ModelEvent($model, $this->getContainer()));
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

    public function isDebug()
    {
        return $this->get('kernel')->isDebug();
    }

    public function getFlashSave()
    {
        return $this->container->get('translator')->trans('artesanus.msn_flash.saved', array(), 'ArtesanusBundle');
    }

    public function getFlashRemove()
    {
        return $this->container->get('translator')->trans('artesanus.msn_flash.removed', array(), 'ArtesanusBundle');
    }

    public function redirectTo($request, $parameters = null, $status = 302)
    {
        $submitAction = 'edit';

        if($request->request->get('new')){
            $submitAction = 'new';
            $parameters = array();
        }

        if($request->request->get('close')){
            $submitAction = 'close';
            $parameters = array();
        }

        return new RedirectResponse($this->container->get('router')->generate($this->submitActionRoutes()[$submitAction], $parameters), $status);
    }

    public function submitActionRoutes()
    {
        return array(
            'edit' => $this->entityPrefix().'_edit',
            'new' => $this->entityPrefix().'_new',
            'close' => $this->entityPrefix()
        );
    }

    public function tableFields()
    {
        return array('id');
    }

    public function routeList()
    {
        return $this->entityPrefix();
    }

    public function routeNew()
    {
        return $this->entityPrefix().'_new';
    }

    public function routeEdit()
    {
        return $this->entityPrefix().'_edit';
    }

    public function routeDelete()
    {
        return $this->entityPrefix().'_delete';
    }

}
