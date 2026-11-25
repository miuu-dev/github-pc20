import sqlite3

miConexion = sqlite3.connect("GestionStock")

miCursor = miConexion.cursor()

# miCursor.execute("drop table if exists productos")

# AUTOINCREMENT solo funciona si es 'int primary key'
miCursor.execute(''' 

    create table if not exists productos (
        codigo integer primary key AUTOINCREMENT, 
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

# si queremos ponerlo de esta forma, ha de llevar siempre NULL
miCursor.executemany("insert or ignore into productos values (NULL,?,?,?)", productos)

# también podemos poner: miCursor.execute("insert or ignore into productos (nombre, precio, seccion) values (?,?,?)", ("Raqueta", 90, "Deportes"))
miCursor.execute("insert or ignore into productos values (NULL, 'Raqueta', 90, 'Deportes')")
miCursor.execute("insert or ignore into productos values (NULL, 'Guantes de escalada', 35, 'Deportes')")

miConexion.commit()

miCursor.close()
miConexion.close()