<?php

namespace App\Controller;

use \Doctrine\ORM\EntityManager;
use App\Repository\TiposDocumentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;

class UploadsFileController extends AbstractController
{

    /**
     * @Route("/uploadFile", name="uploadFile")
     * 
     */
    public function uploadFile(Request $request): JsonResponse
    {

        try {
            $response = new JsonResponse();
            $file_path = "";
            $idSub = $_POST['id_subsidio'];

            //verificamos si es unformulario de inscripcion el que se va a guardar
            if ($_POST['guardarFormulario']) {

                $file_path = "/home/seedch/public_html/subsidiosComfenalco/public/uploads/formularioInscripcion/" . $idSub . "_" . basename($_FILES['uploaded_file']['name']);
            }
            if ($_POST['guardarEvidencia']) {
                $pathEvidenciaSubsidio = "/home/seedch/public_html/subsidiosComfenalco/public/uploads/evidenciasSubsidio/" . $idSub;

                if (creaeteDomFolder($pathEvidenciaSubsidio)) {

                    $file_path = $pathEvidenciaSubsidio . "/" . $_POST['idProgRequerimiento'] . "_" . basename($_FILES['uploaded_file']['name']);
                } else {
                    $response->setData(['success' => false, 'msj' => "no se pudo crear la ubicacion la evidencia del subcidio"]);
                    return $response;
                }
            }



            if ($file_path != "") {
                if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
                    $response->setData(['success' => true, 'msj' => "Archivo cargado! "]);
                    return $response;
                } else {
                    $response->setData(['success' => false, 'msj' => "Error al mover el Archivo!"]);
                    return $response;
                }
            } else {
                $response->setData(['success' => false, 'msj' => "no se pudo crear la ubicacion para el archivo"]);
                return $response;
            }
        } catch (Exception $error) {
            $response->setData(['success' => false, 'msj' => "No se pudo registrar el anexo\nerror: {$error->getMessage()}"]);
            return $response;
        }
    }


    function creaeteDomFolder($nameFolder){

        if (!is_dir($nameFolder) ){
            mkdir($nameFolder, 0755, true);
            return true;
        }
        
        return false;
    }
}
