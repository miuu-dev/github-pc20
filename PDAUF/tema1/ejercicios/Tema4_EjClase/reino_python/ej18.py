import sqlite3

miConexion = sqlite3.connect('Bestiario')
miCursor = miConexion.cursor()

try:

    miCursor.execute('''
        create table if not exists bestiario (
            id integer primary key autoincrement,
            nombre varchar(50) unique,
            tipo varchar(20),
            vida integer,
            recompensa integer
        )
    ''')

    fichero = open('bestiario.txt', 'rt', encoding='utf-8')

    criaturas = [] # creación de tupla

    lineas = fichero.readlines()
    for linea in lineas:
        lineaLimpia = linea.strip() 

        if lineaLimpia == "":
            continue #saltar líneas vacías

        nombre, tipo, vida, recompensa = lineaLimpia.split(";") # asigamos cada valor que es dividido por un ; en su celda

        criaturas.append((nombre, tipo, int(vida), int(recompensa))) # lo metemos dentro de la tupla criaturas e indicamos el tipo que son vida y recompensa para evitar fallos

        print(f"Se han insertado {miCursor.rowcount} criaturas correctamente.")

    miCursor.executemany("insert into bestiario values (NULL, ?,?,?,?)", criaturas)

    miConexion.commit()

except sqlite3.IntegrityError as error:
    print(f"Error: {error}")



miCursor.close()
miConexion.close()