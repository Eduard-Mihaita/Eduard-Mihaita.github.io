import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

tw_username = "TEnderdj30298"
tw_mail = "mihaita_e@yahoo.ro"
tw_password = "bottest1243!"

class InternetSpeedTwitterBot:
    def __init__(self):
        self.driver = webdriver.Chrome()
        self.up = 0
        self.down = 0
    def get_internet_speed(self):
        self.driver.get("https://www.speedtest.net/")
        time.sleep(2)
        gdpr = self.driver.find_element(by=By.ID, value="onetrust-accept-btn-handler")
        gdpr.click()
        go = self.driver.find_element(by=By.XPATH, value='//*[@id="container"]/div[1]/div[3]/div/div/div/div[2]/div[2]/div/div[2]/a')
        go.click()
        time.sleep(40)
        self.up = self.driver.find_element(by=By.CLASS_NAME, value="upload-speed").text
        self.down = self.driver.find_element(by=By.CLASS_NAME, value="download-speed").text
    def tweet_at_provider(self):
        self.driver.get("https://x.com/i/flow/login")
        time.sleep(5)
        username = self.driver.find_element(by=By.XPATH, value='//*[@id="layers"]/div/div/div/div/div/div/div[2]/div[2]/div/div/div[2]/div[2]/div/div/div/div[4]/label/div/div[2]/div/input')
        username.send_keys(tw_username)
        time.sleep(2)
        username.send_keys(Keys.ENTER)
        time.sleep(10)
        mail = self.driver.find_element(by=By.XPATH, value='//*[@id="layers"]/div/div/div/div/div/div/div[2]/div[2]/div/div/div[2]/div[2]/div[1]/div/div[2]/label/div/div[2]/div/input')
        mail.send_keys(tw_mail)
        time.sleep(2)
        mail.send_keys(Keys.ENTER)
        time.sleep(10)
        password = self.driver.find_element(by=By.NAME, value="password")
        password.send_keys(tw_password)
        time.sleep(2)
        password.send_keys(Keys.ENTER)
        time.sleep(10)
        compose = self.driver.find_element(by=By.XPATH, value='//*[@id="react-root"]/div/div/div[2]/main/div/div/div/div/div/div[3]/div/div[2]/div[1]/div/div/div/div[2]/div[1]/div/div/div/div/div/div/div/div/div/div/div/div[1]/div/div/div/div/div/div[2]/div/div/div/div')
        compose.click()
        time.sleep(2)
        compose.send_keys(f"Viteza de download este {self.down} Mbps, iar cea de upload este {self.up} Mbps")
        post = self.driver.find_element(by=By.XPATH, value='//*[@id="react-root"]/div/div/div[2]/main/div/div/div/div/div/div[3]/div/div[2]/div[1]/div/div/div/div[2]/div[2]/div[2]/div/div/div/button/div/span/span')
        post.click()
bot = InternetSpeedTwitterBot()
bot.get_internet_speed()
bot.tweet_at_provider()