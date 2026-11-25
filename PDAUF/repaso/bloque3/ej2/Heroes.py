import sqlite3

conexion = None
cursor = None

try:
    # 1. conectar bbdd
    conexion = sqlite3.connect('Heroes.db')
    cursor = conexion.cursor()

    # 1.1. crear tabla
    query = '''
        create table if not exists heroes (
            id integer primary key autoincrement,
            nombre varchar(50) unique,
            clase varchar(20),
            nivel integer
        )
    '''
    cursor.execute(query)
    
    # 2. insertar mediante executemany
    heroes = [
        ('Aria Vientoalto', 'Exploradora', 3), 
        ('Bruno Martillo', 'Guerrero', 5), 
        ('Selene Lunaplata', 'Maga', 4)
    ]
    
    cursor.executemany('insert into heroes values (NULL, ?, ?, ?)', heroes)
    
    # 3. guardar
    conexion.commit()
    
    # 4. consulta
    query2 = 'select * from heroes where nivel >= 4'
    cursor.execute(query2)
    
    resultado = cursor.fetchall()
    for heroe in resultado:
        print(heroe)

except sqlite3.IntegrityError as e:
    print(f'Error: {e}')
    
finally:
    if conexion and cursor:
        cursor.close()
        conexion.close()