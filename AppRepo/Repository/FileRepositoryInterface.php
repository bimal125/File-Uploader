<?php
namespace AppRepo\Repository;

interface FileRepositoryInterface
{
    public function fileUpload($file);

    function create_zip($files = array(),$destination = '',$overwrite = false);
}