from email import header
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time
import requests

URL = "https://appbrewery.github.io/Zillow-Clone/"
header = {
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0",
    "Accept-Language": "en-US,en;q=0.5"
}

response = requests.get(URL, headers = header)
soup = BeautifulSoup(response.content, "html.parser")

properties = soup.find_all(name = "a" , class_ = "StyledPropertyCardDataArea-anchor")
property_addresses = []
property_links = []
for property_tag in properties:
    address = property_tag.getText().strip().strip("|")
    property_addresses.append(address)
    link = property_tag.get("href")
    property_links.append(link)
property_prices = [score.getText().strip("/mo").strip("+").strip("+1 bd") for score in soup.find_all(name = "span" , class_ = "PropertyCardWrapper__StyledPriceLine")]

print(property_addresses)
print(property_links)
print(property_prices)

#Selenium
chrome_options = webdriver.ChromeOptions() # pastreaza chrome deschis dupa finalizarea programului
chrome_options.add_experimental_option("detach", True)
driver = webdriver.Chrome(options=chrome_options)

for n in range(len(property_links)):
    driver.get("https://forms.gle/BmuxTTU978xMo68y7")
    time.sleep(2)
    address_field = driver.find_element(by=By.XPATH, value='//*[@id="mG61Hd"]/div[2]/div/div[2]/div[1]/div/div/div[2]/div/div[1]/div/div[1]/input')
    price_field = driver.find_element(by=By.XPATH, value='//*[@id="mG61Hd"]/div[2]/div/div[2]/div[2]/div/div/div[2]/div/div[1]/div/div[1]/input')
    link_field = driver.find_element(by=By.XPATH, value='//*[@id="mG61Hd"]/div[2]/div/div[2]/div[3]/div/div/div[2]/div/div[1]/div/div[1]/input')
    submit_button = driver.find_element(by=By.XPATH, value='//*[@id="mG61Hd"]/div[2]/div/div[3]/div[1]/div[1]/div/span/span')
    address_field.send_keys(property_addresses[n])
    link_field.send_keys(property_links[n])
    price_field.send_keys(property_prices[n])
    submit_button.click()