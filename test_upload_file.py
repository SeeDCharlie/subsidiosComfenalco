import requests

urlFormSubsidio = 'https://comfenalcosubsidios.seedcharlie.co/registrarSubsidio'

url = 'http://127.0.0.1:8000/registrarSubsidio'

#archivo que se va a cargar
files = {'uploaded_file': open('/home/seed/Imágenes/fp.jpg','rb')}

#valores para la carga de un requerimiento de un subcidio
valuesForRequirement = {'id_subsidio': 88,'idProgRequerimiento': 8,'guardarEvidencia':True}

#valores para la carga de un formulario de inscripcion 
valuesForForm = {'idUsr': 6, 'idPrograma': 2 ,'fechaFinalizacion': '1994-06-04'}

r = requests.post(url, files=files, data=valuesForForm)

print("estado respuesta : " + str(r.status_code) + "\ncontenido respuesta : "  + str(r.content))


