<?php
namespace AppRepo\Services;
use AppRepo\Repository\UploadRepositoryInterface;

class UploadService extends BaseService
{
	
    public function __construct(UploadRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function fileUpload($data)
    {
        return $this->repo->fileUpload($data);
    }
}