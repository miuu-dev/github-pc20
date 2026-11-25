import sqlite3

miConexion = sqlite3.connect("GestionStock2")

miCursor = miConexion.cursor()

miCursor.execute(''' 
    create table productos(
        id integer primary key autoincrement,
        nombre varchar(50),
        precio integer,
        seccion varchar(20)
    )
''')

productos = [
    ("Bañador", 22, "Verano"),
    ("Toalla", 15, "Verano"),
    ("Manguera", 40, "Jardín"),
    ("Cubo", 3, "Jardín")
]

miCursor.executemany("insert into productos values (NULL,?,?,?)", productos)

miConexion.commit()

miCursor.close()
miConexion.close()