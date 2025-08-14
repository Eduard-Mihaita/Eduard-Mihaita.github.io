import requests
from twilio.rest import Client

owm_api_key = ""
twilio_account_sid = ''
twilio_auth_token = ''
client = Client(twilio_account_sid, twilio_auth_token)

OWM_endpoint = "http://api.openweathermap.org/data/2.5/forecast"

weather_params = {
    "lat": 55.31667,
    "lon": 5.63333,
    "appid": owm_api_key,
    "cnt": 4,
    "units": "metric",
}

response = requests.get(OWM_endpoint, params= weather_params)
response.raise_for_status()
weather_data = response.json()

will_rain = False
for hour_data in weather_data["list"]:
    condition_code = hour_data["weather"][0]["id"]
    if int(condition_code) >= 500 and condition_code < 600:
        will_rain = True
if will_rain:
    message = client.messages.create(
        from_ = 'whatsapp:+',
        to = 'whatsapp:+',
        body = "Astazi o sa ploua, pregateste o umbrela"
        )