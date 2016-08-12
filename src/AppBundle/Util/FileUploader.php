<?php 
namespace AppBundle\Util;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $diretorio;

    public function __construct($diretorio)
    {
        $this->diretorio = $diretorio;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $file->move($this->diretorio, $fileName);

        return $fileName;
    }
}
