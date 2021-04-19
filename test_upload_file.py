import requests

url = 'https://comfenalcosubsidios.seedcharlie.co/uploadFile.php'
files = {'uploaded_file': open('/home/seed/Imágenes/fp.jpg','rb')}
values = {'id': '333', 'uploadForm':True}

r = requests.post(url, files=files, data=values)
print(r)