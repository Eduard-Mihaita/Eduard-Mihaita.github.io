import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

# Pastreaza Chrome deschis dupa finalizarea programului
chrome_options = webdriver.ChromeOptions()
chrome_options.add_experimental_option("detach", True)
driver = webdriver.Chrome(options=chrome_options)
driver.get("https://tinder.com/")

#Cauta si apasa "I decline" la cookies
decline_cookies = driver.find_element(by=By.XPATH, value='//*[@id="u-1060703220"]/div/div[2]/div/div/div[1]/div[2]/button')
decline_cookies.click()

#Cauta si apasa butonul de login
login_button = driver.find_element(by=By.XPATH, value='//*[@id="u-1060703220"]/div/div[1]/div/main/div[1]/div/div/div/div/div[1]/header/div/div[2]/div[2]/a')
login_button.click()
time.sleep(2)

#Facebook login
facebook_login = driver.find_element(by=By.XPATH, value='//*[@id="u1505883000"]/div/div/div/div[2]/div/div/div[2]/div[2]/span/div[2]/button')
facebook_login.click()
fb_login_window = driver.window_handles[1] 
driver.switch_to.window(fb_login_window)#schimba window-ul la pop-up de Facebook login
decline_cookies_fb = driver.find_element(by=By.XPATH, value='//*[@id="facebook"]/body/div[2]/div[2]/div/div/div/div/div[3]/div[2]/div/div[1]')
decline_cookies_fb.click()
fb_email = driver.find_element(by=By.XPATH, value='//*[@id="email"]')
fb_password = driver.find_element(by=By.XPATH, value='//*[@id="pass"]')
fb_email.send_keys("jihem27934@ahvin.com")
fb_password.send_keys("tinderbot1243!")
fb_password.send_keys(Keys.ENTER)
time.sleep(2)

#Inapoi la fereastra de Tinder
base_window = driver.window_handles[0]
driver.switch_to.window(base_window)

#de adaugat allow location
#de adaugat decline notification
#de adaugat cookie consent

#Like
like = driver.find_element(by=By.XPATH, value='//*[@id="main-content"]/div[1]/div/div/div/div[1]/div/div/div[4]/div/div[4]/button')
like.click()
time.sleep(5)