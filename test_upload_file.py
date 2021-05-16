import requests

urlFormSubsidio = 'https://comfenalcosubsidios.seedcharlie.co/registrarSubsidio'
urlAnexoDos = 'https://comfenalcosubsidios.seedcharlie.co/registrarAnexo'

urlSubsidio = 'http://127.0.0.1:8000/registrarSubsidio'
urlAnexo = 'http://127.0.0.1:8000/registrarAnexo'
#archivo que se va a cargar
files = {'uploaded_file': open('/home/seed/Imágenes/Fer 20180904_220039.jpg','rb')}

#valores para la carga de un requerimiento de un subcidio
valuesForRequirement = {'idSubsidio': 25,'idProgRequerimiento': 2,'estado':'estado prub', 'observaciones':'observacion prub'}

#valores para la carga de un formulario de inscripcion 
valuesForForm = {'idUsr': 60, 'idPrograma': 3,'fechaFinalizacion': '1994-06-04'}

r = requests.post(urlFormSubsidio, files=files, data=valuesForForm)

print("estado respuesta : " + str(r.status_code) + "\ncontenido respuesta : "  + str(r.content))



