<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StorageController extends Controller
{
    public function filesAction(Request $request)
    {

        $filesManager = $this->get('artesanus.files_manager');

        $files = $filesManager->findAll();

        $file = $filesManager->create();

        $fileForm = $this->createForm('artesanus_files_type', $file)->handleRequest($request);

        if($fileForm->isValid()){
            $filesManager->save($file);
            $this->get('artesanus.flashers')->add('info','Archivo guardado');
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

        $files = $filesManager->findOneBy(array('id' => $id));

        $filesManager->delete($files);

        $this->get('artesanus.flashers')->add('danger','Archivo removido');

        return $this->redirect($this->generateUrl('artesanus_console_storage'));

    }
}
