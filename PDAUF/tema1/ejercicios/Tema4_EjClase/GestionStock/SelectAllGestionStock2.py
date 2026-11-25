import sqlite3

miConexion = sqlite3.connect("GestionStock2")

miCursor = miConexion.cursor()

miCursor.execute("SELECT * from productos")

productos = miCursor.fetchall()

print(productos)

miConexion.commit()

miCursor.close()
miConexion.close()