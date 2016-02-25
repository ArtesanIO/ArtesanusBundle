<?php

namespace ArtesanIO\ArtesanusBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;

class CategoriesManager extends ModelManager
{
    public function tableFields()
    {
        return array('id','category', null);
    }
}
