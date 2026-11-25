import sqlite3

conexion = None
cursor = None

try: 
    # 1. conectar a la bbdd
    conexion = sqlite3.connect('Bestiario.db')
    cursor = conexion.cursor()
    
    # 1.1. crear tabla monstruos
    crearTabla = '''
        create table if not exists monstruos (
            id integer primary key autoincrement,
            nombre varchar(50) unique,
            tipo varchar(20),
            vida integer,
            recompensa integer
        )
    '''
    cursor.execute(crearTabla)
    
    # 2. leer línea por línea
    fichero = open('bestiario.txt', 'r+', encoding='utf-8')
    
    insertados = 0
    rechazados = 0
    
    for linea in fichero:
        # limpiar salto de linea (strip) y separar por ; (split)
        datos = linea.strip().split(';')
        
        # si hay líneas vacías con
        if len(datos) != 4:
            continue
        
        # convertimos los datos en sus respectivos puestos
        nombre = datos[0]
        tipo = datos[1]
        vida = int(datos[2])
        recompensa = int(datos[3])
        
        # metemos los datos obtenidos anteriormente en su respectiva columna
        try:
            cursor.execute('insert into monstruos values (NULL, ?, ?, ?, ?)', (nombre, tipo, vida, recompensa))
            insertados += 1
            
        # en caso de que de error, lo metemos dentro del fichero errores.txt
        except sqlite3.IntegrityError:
            ficheroError = open('errores.txt', 'a', encoding='utf-8')
            ficheroError.write(f'Duplicado rechazado: {nombre}\n')
            rechazados += 1
    
    # mostramos por pantalla cuantos fueros registrados y rechazados... SE PONE FUERA DEL BUCLE
    conexion.commit()
    print(f'Registros insertados: {insertados}')
    print(f'Registros rechazados: {rechazados}')
    
except (OSError, ValueError, sqlite3.Error) as e:
    print(f'Error general durante el proceso: {e}')
    
finally:
    if cursor:
        cursor.close()
        
    if conexion:
        conexion.close()