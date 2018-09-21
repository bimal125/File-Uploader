<?php
namespace AppRepo\Services;
use AppRepo\Repository\FileRepositoryInterface;

class FileService extends BaseService
{
	
    public function __construct(FileRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function fileUpload($data)
    {
        return $this->repo->fileUpload($data);
    }
}