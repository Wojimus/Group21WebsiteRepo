import mysql.connector

mydb = mysql.connector.connect(
    host="group21database.cwh7m6t1aild.us-east-1.rds.amazonaws.com",
    user="Group21Admin",
    password="Group21Password"
)

mycursor = mydb.cursor()
mycursor.execute("CREATE DATABASE group21database")

mycursor.close()

mydb2 = mysql.connector.connect(
    host="group21database.cwh7m6t1aild.us-east-1.rds.amazonaws.com",
    user="Group21Admin",
    password="Group21Password",
    database="group21database"
)

with open('19112322.sql', 'r', encoding='utf-8') as f:
    with mydb2.cursor() as cursor:
        cursor.execute(f.read(), multi=True)
