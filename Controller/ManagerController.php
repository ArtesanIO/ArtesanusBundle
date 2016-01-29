<?php

namespace ArtesanIO\ArtesanusBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManagerController extends Controller
{
    public function listAction(Request $request)
    {
        $routeName = $request->get('_route');

        echo $routeName;
        exit('List');
    }

    public function newAction()
    {
        exit('New');
    }

    public function editAction()
    {
        exit('edit');
    }

    public function deleteAction()
    {
        exit('remove');
    }
}
