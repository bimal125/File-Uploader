<?php
namespace AppRepo\Repository\Eloquent;
use App\File;
use App\UploadHandler;
use AppRepo\Repository\UploadRepositoryInterface;

class UploadEloquentRepository extends BaseEloquentRepository implements UploadRepositoryInterface
{
    public function __construct(File $file)
    {
        $this->model = $file;
    }

    public function fileUpload($data)
    {
        $file = new File();
        $uploader = new UploadHandler();

        // Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $uploader->allowedExtensions = array(); // all files types allowed by default

        // Specify max file size in bytes.
        $uploader->sizeLimit = null;

        // Specify the input name set in the javascript.
        $uploader->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default

        // If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
        $uploader->chunksFolder = "chunks";

        $method = $uploader->isMethod();
        if ($method == "POST") {
            header("Content-Type: text/plain");

            // Assumes you have a chunking.success.endpoint set to point here with a query parameter of "done".
            // For example: /myserver/handlers/endpoint.php?done
            if (isset($_GET["done"])) {
                $result = $uploader->combineChunks("files");
            }
            // Handles upload requests
            else {
                // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
                $result = $uploader->handleUpload("images");

                // To return a name used for uploaded file you can use the following line.
                $result["uploadName"] = $uploader->getUploadName();

                if($result['success']== 1)
                {
                    $file->filename = $uploader->getUploadName();
                    $file->save();
                }
            }
            echo json_encode($result);
        }
        // for delete file requests
        else if ($method == "DELETE") {
            $result = $uploader->handleDelete("files");
            echo json_encode($result);
        }
        else {
            header("HTTP/1.0 405 Method Not Allowed");
        }
    }
}