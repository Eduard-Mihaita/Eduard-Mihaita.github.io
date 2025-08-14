import requests
from datetime import datetime

pixela_username = ""
pixela_token = ""
pixela_endpoint = "https://pixe.la/v1/users"
pixela_graph_id = "graph1"

pixela_headers = {
    "X-USER-TOKEN": pixela_token
}
user_params = {
    "token": pixela_token,
    "username": pixela_username,
    "agreeTermsOfService": "yes",
    "notMinor": "yes"
}

# https://pixe.la/v1/users/eduardmihaita/graphs/graph1.html
# Initializeaza user-ul
# response = requests.post(url = pixela_endpoint, json = user_params)
today = datetime.now()
steps = input("Cati pasi ai facut azi?\n")

# Creeaza graficul
graph_endpoint = f"{pixela_endpoint}/{pixela_username}/graphs"
graph_config = {
    "id": "graph1",
    "name": "Cat am mers azi?",
    "unit": "Steps",
    "type": "int",
    "color": "ajisai",
    "startOnMonday": True
    }
# response = requests.post(url = graph_endpoint, json = graph_config, headers=pixela_headers)

# Adauga pixeli in grafic pentru ziua de azi
pixel_add = f"{pixela_endpoint}/{pixela_username}/graphs/{pixela_graph_id}"
pixel_config = {
    "date": today.strftime("%Y%m%d"),
    "quantity": steps,
    }
requests.post(url = pixel_add, json = pixel_config, headers=pixela_headers)

# Modifica pixelul de azi
# update_endpoint = f"{pixela_endpoint}/{pixela_username}/graphs/{pixela_graph_id}/{today.strftime('%Y%m%d')}"
# new_pixel_data = {
#     "quantity": "100"
# }
# requests.put(url= update_endpoint, json = new_pixel_data, headers=pixela_headers)

# Sterge pixelul de azi
# requests.delete(url = update_endpoint, headers=pixela_headers)