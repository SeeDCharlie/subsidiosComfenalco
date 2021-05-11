import requests

urlFormSubsidio = 'https://comfenalcosubsidios.seedcharlie.co/registrarSubsidio'

urlSubsidio = 'http://127.0.0.1:8000/registrarSubsidio'
urlAnexo = 'http://127.0.0.1:8000/registrarAnexo'
#archivo que se va a cargar
files = {'uploaded_file': open('/home/seed/Imágenes/fp.jpg','rb')}

#valores para la carga de un requerimiento de un subcidio
valuesForRequirement = {'idSubsidio': 25,'idProgRequerimiento': 2,'estado':'estado prub', 'observaciones':'observacion prub'}

#valores para la carga de un formulario de inscripcion 
valuesForForm = {'idUsr': 59, 'idPrograma': 3,'fechaFinalizacion': '1994-06-04'}

r = requests.post(urlAnexo, files=files, data=valuesForRequirement)

print("estado respuesta : " + str(r.status_code) + "\ncontenido respuesta : "  + str(r.content))


