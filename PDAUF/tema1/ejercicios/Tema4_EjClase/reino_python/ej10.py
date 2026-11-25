import sqlite3

miConexion = sqlite3.connect("Gremio")
miCursor = miConexion.cursor()

miCursor.execute('''
    create table if not exists armas(
        nombre varchar(40),
        dano int,
        tipo varchar(20)
    )
''')

miCursor.close()
miConexion.close()