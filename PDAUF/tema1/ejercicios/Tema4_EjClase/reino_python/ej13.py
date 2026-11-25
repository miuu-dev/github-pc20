import sqlite3

miConexion = sqlite3.connect("Heroes")
miCursor = miConexion.cursor()

miCursor.execute('''
    create table if not exists heroes (
        id integer primary key autoincrement,
        nombre varchar(50) unique,
        clase varchar(20),
        nivel integer
    )
''')

heroes = [
    ('Aria Vientoalto', 'Exploradora', 3),
    ('Bruno Martillo', 'Guerrero', 5),
    ('Selene Lunaplata', 'Maga', 4),
    ('Fidel Zarzamora', 'Clérigo', 2)
]
sql_insertar = 'insert into heroes values(NULL,?,?,?)'
miCursor.executemany(sql_insertar, heroes)

miConexion.commit()

miCursor.close()
miConexion.close()