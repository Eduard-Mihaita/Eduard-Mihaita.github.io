import random
import smtplib
import datetime
import pandas

my_email = ""
my_password = ""

today = (datetime.datetime.now().month, datetime.datetime.now().day)

data = pandas.read_csv("Python Projects\Day 32 - Email Sender + Date Manager\birthdays.csv")
birthday_dictionary = {(data_row["month"], data_row["day"]): data_row for (index, data_row) in data.iterrows()}

if today in birthday_dictionary:
    birthday_person = birthday_dictionary[today]
    file_path = f"Python Projects\Day 32 - Email Sender + Date Manager\letter_templates\letter_{random.randint(1,3)}.txt"
    with open(file_path) as letter_file:
        contents = letter_file.read()
        contents = contents.replace("[NAME]",birthday_person["name"])
    with smtplib.SMTP("smtp.gmail.com") as connection:
        connection.starttls()
        connection.login(user = my_email, password = my_password)
        connection.sendmail(from_addr = my_email,
                            to_addrs = birthday_person["email"],
                            msg = f"Subject:Happy Birthday!\n\n{contents}"
                            )
        connection.close()