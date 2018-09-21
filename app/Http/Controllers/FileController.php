<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Input;
use Response;
use AppRepo\Services\FileService;


class FileController extends Controller
{
    protected $service;

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return view('create');
    }

    public function store(FileRequest $request)

    {
        $file = $this->service->fileUpload($request);
        return view('create',compact('file'))->with('success','Your files has been successfully added');
    }


    public function download ($filename)
    {
        $fileurl = public_path().'/files/zips';
        return Response::download($fileurl.'/'.$filename,"www.fineuploader".$filename, array('Content-Type: application/zip','Content-Length: '. filesize($fileurl))); 
    }
}
