<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StorageController extends Controller
{
    public function filesAction(Request $request)
    {

        $filesManager = $this->get('artesanus.files_manager');

        $files = $filesManager->getRepository()->findAll();

        $file = $filesManager->create();

        $fileForm = $this->createForm('artesanus_files_type', $file)->handleRequest($request);

        if($fileForm->isValid()){
            $filesManager->save($file);
            return $this->redirect($this->generateUrl('artesanus_console_storage'));
        }

        return $this->render('ArtesanusBundle:Storage:files.html.twig', array(
            'files' => $files,
            'files_form' => $fileForm->createView()
        ));
    }

    public function filesRemoveAction($id, Request $request)
    {

        $filesManager = $this->get('artesanus.files_manager');

        $files = $filesManager->getRepository()->findOneBy(array('id' => $id));

        $filesManager->delete($files);

        return $this->redirect($this->generateUrl('artesanus_console_storage'));

    }

    public function categoriesAction(Request $request)
    {

        $categoriesManager = $this->get('artesanus.categories_manager');

        $categories = $categoriesManager->getRepository()->findAll();

        $category = $categoriesManager->create();

        $categoryForm = $this->createForm('artesanus_categories_type', $category)->handleRequest($request);

        if($categoryForm->isValid()){

            $slug = $this->get('artesanus.slugger')->slugify($category->getCategory());

            $category->setSlug($slug);

            $categoriesManager->save($category);
            return $this->redirect($this->generateUrl('artesanus_console_storage_categories'));
        }

        return $this->render('ArtesanusBundle:Storage:categories.html.twig', array(
            'categories' => $categories,
            'category_form' => $categoryForm->createView()
        ));
    }

    public function categoryAction($id, Request $request)
    {

        $categoriesManager = $this->get('artesanus.categories_manager');

        $category = $categoriesManager->getRepository()->findOneBy(array('id' => $id));

        $categoryForm = $this->createForm('artesanus_categories_type', $category)->handleRequest($request);

        if($categoryForm->isValid()){
            $categoriesManager->save($category);
            return $this->redirect($this->generateUrl('artesanus_console_storage_category', array('id' => $category->getId())));
        }

        return $this->render('ArtesanusBundle:Storage:category.html.twig', array(
            'category_form' => $categoryForm->createView()
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $categoriesManager = $this->get('artesanus.categories_manager');

        $category = $categoriesManager->getRepository()->findOneBy(array('id' => $id));

        $categoriesManager->delete($category);

        return $this->redirect($this->generateUrl('artesanus_console_storage_categories'));
    }

}
