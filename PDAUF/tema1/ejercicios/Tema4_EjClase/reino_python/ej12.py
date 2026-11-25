import sqlite3

miConexion = sqlite3.connect("Gremio")
miCursor = miConexion.cursor()

# 1.
miCursor.execute('select * from armas')
armas = miCursor.fetchall()
print(armas)

# 2.
for arma in armas:
    print('\nArma: ', arma[0], '| Daño: ', arma[1])

# 3.
miCursor.execute('select * from armas')
print('\n', miCursor.fetchone())

miConexion.commit()

miCursor.close()
miConexion.close()