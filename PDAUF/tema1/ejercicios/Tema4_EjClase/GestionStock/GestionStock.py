import sqlite3

miConexion = sqlite3.connect("GestionStock")

miCursor = miConexion.cursor()

miCursor.execute(''' 
    create table productos(
        codigo varchar(4) primary key,
        nombre varchar(50),
        precio integer,
        seccion varchar(20)
    )
''')

productos = [
    ("CO01", "Bañador", 22, "Verano"),
    ("CO02", "Toalla", 15, "Verano"),
    ("CO03", "Manguera", 40, "Jardín"),
    ("CO04", "Cubo", 3, "Jardín")
]

miCursor.executemany("insert into productos values (?,?,?,?)", productos)

miConexion.commit()

miCursor.close()
miConexion.close()