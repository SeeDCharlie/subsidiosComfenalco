import requests

url = 'https://comfenalcosubsidios.seedcharlie.co/uploadFile.php'
files = {'uploaded_file': open('/home/seed/Imágenes/fp.jpg','rb')}
values = {'id_subsidio': 88,'idProgRequerimiento': 8,'guardarEvidencia':True}

r = requests.post(url, files=files, data=values)
print(r)