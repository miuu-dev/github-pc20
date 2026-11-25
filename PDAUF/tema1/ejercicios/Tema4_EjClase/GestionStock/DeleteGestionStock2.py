import sqlite3

miConexion = sqlite3.connect("GestionStock2")

miCursor = miConexion.cursor()

miCursor.execute("Delete from productos where id = 1")

miConexion.commit()

miCursor.close()
miConexion.close()