import sqlite3

miConexion = sqlite3.connect("Gremio")
miCursor = miConexion.cursor()

# miCursor.execute('''
#     create table if not exists armas(
#         nombre varchar(40),
#         dano int,
#         tipo varchar(20)
#     )
# ''')
# ~~ PARTE 1 ~~
miCursor.execute('insert into armas values (?,?,?)', ('Espada corta', 6, 'Cuerpo a cuerpo')) # al ejecutarlo por segunda vez, se duplica, pero con otro id

# ~~ PARTE 2 ~~
armas = [
    ('Arco largo', 8, 'Distancia'),
    ('Hacha de guerra', 10, 'Cuerpo a cuerpo'),
    ('Daga envenenada', 4, 'Cuerpo a cuerpo'),
]
miCursor.executemany('insert into armas values (?,?,?)', armas)

miConexion.commit()

miCursor.close()
miConexion.close()