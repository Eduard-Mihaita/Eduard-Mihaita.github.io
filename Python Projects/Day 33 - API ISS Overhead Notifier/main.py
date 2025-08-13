import smtplib
import requests
from datetime import datetime

MY_LAT = 44.443185 # Your latitude
MY_LONG = 26.037590 # Your longitude
MY_EMAIL = ""
MY_PASSWORD = ""

def is_iss_overhead():
    response = requests.get(url="http://api.open-notify.org/iss-now.json")
    response.raise_for_status()
    data = response.json()
    iss_latitude = float(data["iss_position"]["latitude"])
    iss_longitude = float(data["iss_position"]["longitude"])
    if MY_LAT-5 <= iss_latitude <= MY_LAT+5 and MY_LONG-5 <= iss_longitude < MY_LONG+5: # Verifica daca ISS este intre -5 si +5 fata de coordonatele curente
        return True

def is_night():
    parameters = {
        "lat": MY_LAT,
        "lng": MY_LONG,
        "formatted": 0,
    }
    response = requests.get("https://api.sunrise-sunset.org/json", params=parameters)
    response.raise_for_status()
    data = response.json()
    sunrise = int(data["results"]["sunrise"].split("T")[1].split(":")[0]) # Verifica ora rasaritului
    sunset = int(data["results"]["sunset"].split("T")[1].split(":")[0]) # Verifica ora apusului
    time_now = datetime.now().hour
    if time_now >= sunset and time_now <= sunrise: # Verifica daca e noapte
        return True

if is_iss_overhead() and is_night(): # Daca ISS e in zona si e noapte trimite mailul
    connection = smtplib.SMTP("smtp.gmail.com")
    connection.starttls()
    connection.login(user = MY_EMAIL, password = MY_PASSWORD)
    connection.sendmail(from_addr = MY_EMAIL,
                        to_addrs = MY_EMAIL,
                        msg = "Subject:Vezi sus!\n\nISS este in zona ta"
                        )
    connection.close()