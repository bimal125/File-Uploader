<?php
namespace AppRepo\Repository\Eloquent;
use App\File;
use File as FileMethod;
use ZipArchive;

use AppRepo\Repository\FileRepositoryInterface;

class FileEloquentRepository extends BaseEloquentRepository implements FileRepositoryInterface
{
    public function __construct(File $file)
    {
        $this->model = $file;
    }

    public function fileUpload($request)
    {
        if($request->hasfile('filename'))
        {

            foreach($request->file('filename') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/', $name);  
                $data[] = public_path().'/files/'.$name;  
            }
        }

        $zipName = str_random(32).'.zip';
        $result = $this->create_zip($data,public_path().'/files/zips/'.$zipName);

        if($request->hasfile('filename'))
        {

            foreach($request->file('filename') as $file)
            {
                $name=$file->getClientOriginalName();
                FileMethod::delete((public_path().'/files/'.$name));  
            }
        }
        
        $file= new File();
        $file->filename= $zipName;
        $file->save();
        return $file;
    }

    function create_zip($files = array(),$destination = '',$overwrite = false) {
        
        if(file_exists($destination) && !$overwrite) { return false; }
        $valid_files = array();
        if(is_array($files)) {
            foreach($files as $file) {
                if(file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        if(count($valid_files)) {
            $zip = new ZipArchive();
            if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                return false;
            }
            foreach($valid_files as $file) {
                $zip->addFile($file,$file);
            }
            
            $zip->close();
            
            return file_exists($destination);
        }
        else
        {
            return false;
        }
    }
    
}