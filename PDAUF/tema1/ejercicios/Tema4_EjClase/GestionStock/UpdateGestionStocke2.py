import sqlite3

miConexion = sqlite3.connect("GestionStock2")

miCursor = miConexion.cursor()

miCursor.execute("UPDATE productos set precio = precio + 5")

miConexion.commit()

miCursor.close()
miConexion.close()