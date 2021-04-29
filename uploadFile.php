<?php
 
    function creaeteDomFolder($nameFolder){

        if (!is_dir($nameFolder) ){
            mkdir($nameFolder, 0755, true);
            return true;
        }
        
        return false;
    }
 
    try {
            
        $file_path = "";
        $idSub = $_POST['id_subsidio'];
        
        //verificamos si es unformulario de inscripcion el que se va a guardar
        if($_POST['guardarFormulario']){
        
            $file_path = "/home/seedch/public_html/subsidiosComfenalco/public/uploads/formularioInscripcion/" .$idSub."_".basename($_FILES['uploaded_file']['name']);
        }
        if($_POST['guardarEvidencia']){
            $pathEvidenciaSubsidio = "/home/seedch/public_html/subsidiosComfenalco/public/uploads/evidenciasSubsidio/".$idSub;
            
            if(creaeteDomFolder($pathEvidenciaSubsidio) ){
                
                $file_path = $pathEvidenciaSubsidio."/".$_POST['idProgRequerimiento']."_".basename($_FILES['uploaded_file']['name']);
            }
            else{
                echo "no se pudo crear la ubicacion la evidencia del subcidio";
            }

        }
            
            
            
        if($file_path != ""){
            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        
                echo json_encode(array("ok"=>True,"msj"=>"Archivo cargado! " ), JSON_FORCE_OBJECT);
            } else{
                echo json_encode(array("ok"=>False, "msj"=>"Error al mover el Archivo!" ), JSON_FORCE_OBJECT);
            }
        }else{
            echo "no se pudo crear la ubicacion para el archivo";
        }
        

    } catch (Exception $error) {
        echo "error: {$error}";
    }

 
            
     /*
    curl -D '"name"'-F 'data=@/home/seed/Imágenes/carlitosvltg.jpg' https://comfenalcosubsidios.seedcharlie.co/uploadFile.php
    */
?> 
