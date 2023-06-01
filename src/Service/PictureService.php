<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(UploadedFile $picture, ?string $folder = '')
    {
        //On donne un nouveau nom a l'image
        $fichier = md5(uniqid(rand(), true)) .'.webp';

        // On récupère les infos de l'image
        $picture_infos = getimagesize($picture);

        if($picture_infos === false){
            throw new Exception('Format d\'image incorrect');
        }

        //On vérifie le format de l'image
        switch($picture_infos['mime']){
            case 'image/png':
                $picture_source = imagecreatefrompng($picture);
                break;
            case 'image/jpeg':
                $picture_source = imagecreatefromjpeg($picture);
                break;
            case 'image/webp':
                $picture_source = imagecreatefromwebp($picture);
                    break;
            default:
                throw new Exception('Format d\'image incorrect');
        }

        $path = $this->params->get('images_directory') .$folder;

        $picture->move($path . '/', $fichier);

        return $fichier;

    }


    public function delete (string $fichier, ?string $folder = '')
    {
        if($fichier !== 'default.webp'){
            $success = false;
            $path = $this->params->get('images_directory') .$folder;

        
            $original = $path . '/' . $fichier;

            if(file_exists($original)){
                unlink($original);
                $success = true;
            }
            return $success;
        }
        return false;
    }



}