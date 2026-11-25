import mysql.connector

conn = mysql.connector.connect(
    host="localhost", user="usuario", password="clave", database="mi_bd"
)
cur = conn.cursor()
cur.execute("SELECT VERSION()")
print(cur.fetchone())
conn.close()