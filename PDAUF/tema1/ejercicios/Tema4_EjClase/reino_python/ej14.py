import sqlite3

miConexion = sqlite3.connect('Heroes')
miCursor = miConexion.cursor()

heroe = ('Bruno Martillo', 'Bardo', 1)

try:
    miCursor.execute('insert into heroes values (NULL,?,?,?)', heroe)
    miConexion.commit()
    print('Héroe insertado')
except sqlite3.IntegrityError:
    print('Ya existe un héroe con ese nombre en el gremio.')

miCursor.close()
miConexion.close()