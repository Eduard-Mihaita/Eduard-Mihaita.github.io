from email import header
import smtplib
from bs4 import BeautifulSoup
import requests

MY_EMAIL = ""
MY_PASSWORD = "" 

URL = "https://appbrewery.github.io/instant_pot/"
header = {
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0",
    "Accept-Language": "en-US,en;q=0.5"
}

response = requests.get(URL, headers = header)
soup = BeautifulSoup(response.content, "html.parser")

price = float(soup.find(class_="a-offscreen").getText().split("$")[1])
title = soup.find(id = "productTitle").getText().strip()

if price <= 200:
    connection = smtplib.SMTP("smtp.gmail.com")
    connection.starttls()
    connection.login(user = MY_EMAIL, password = MY_PASSWORD)
    connection.sendmail(from_addr = MY_EMAIL,
                        to_addrs = MY_EMAIL,
                        msg = f"Subject:Alerta pret!\n\nProdusul {title} este la reducere la pretul de: {price}"
                        )
    connection.close()