<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadHandler;
use App\File;
use AppRepo\Services\UploadService;

class UploadController extends Controller
{
    protected $service;

    public function __construct(UploadService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $file = $this->service->fileUpload($request->all());
    }
}
