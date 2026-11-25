import sqlite3

miConexion = sqlite3.connect('Heroes')
miCursor = miConexion.cursor()


try:

    miCursor.execute('select * from heroes where clase = ?', ('Maga',))
    magos = miCursor.fetchall()
    for mago in magos:
        print(mago)

    miConexion.commit()

except sqlite3.IntegrityError:
    print('No hay ninguno de la clase Maga.')

miCursor.close()
miConexion.close()