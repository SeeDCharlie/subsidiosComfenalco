import requests

url = 'https://comfenalcosubsidios.seedcharlie.co/uploadFile'

#archivo que se va a cargar
files = {'uploaded_file': open('/home/seed/Imágenes/fp.jpg','rb')}

#valores para la carga de un requerimiento de un subcidio
valuesForRequirement = {'id_subsidio': 88,'idProgRequerimiento': 8,'guardarEvidencia':True}

#valores para la carga de un formulario de inscripcion 
valuesForForm = {'id_subsidio': 88,'guardarFormulario':True}

r = requests.post(url, files=files, data=valuesForForm)

print(r)