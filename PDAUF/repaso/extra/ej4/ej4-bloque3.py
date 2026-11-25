import mysql.connector

conexion = None
cursor = None

def conector_db():
    return mysql.connector.connect(
        host="127.0.0.1",
        user="miuu",
        password="daw2007_2",
        database="gremio",
        port=41064
    )

def crear_tabla(name):
    sql_create = f'''
        create table if not exists {name} (
        nombre varchar(50) unique,
        tipo varchar(20),
        vida int,
        dano int
    )'''
    cursor.execute(sql_create)
    conexion.commit()
    print(f'Tabla {name} creada correctamente')


try:        
    fichero = open('refuerzos.txt', 'w', encoding='utf-8')
    fichero.write('Basilisco;Monstruo;90;55\n')
    fichero.write('Esqueleto;No muerto;20;6\n')
    fichero.write('Espectro;No muerto;40;18\n')
    fichero.close()
    
    # conectar bbdd
    conexion = conector_db()
    cursor = conexion.cursor()
    crear_tabla("monstruos")
    
    # leer refuerzos son readlines()
    fichero_lectura = open('refuerzos.txt', 'r', encoding='utf-8')
    lineas = fichero_lectura.readlines()
    fichero_lectura.close()
    
    insertados = 0
    rechazados = 0
    
    for linea in lineas:
        datos = linea.strip()
        if not linea:
            continue
        
        datos = linea.split(";")
        nombre = datos[0]
        tipo = datos[1]
        vida = int(datos[2])
        dano = int(datos[3])
        
        sql_insert = 'insert into monstruos (nombre, tipo, vida, dano) values (%s, %s, %s, %s)'
        valores = (nombre, tipo, vida, dano)
        
        try:           
            cursor.execute(sql_insert, valores)
            conexion.commit()
            insertados += 1
            
        except mysql.connector.Error as e:
            rechazados += 1
            ficheroError = open('errores.txt', 'a', encoding='utf-8')
            ficheroError.write(f'Duplicado rechazado: {nombre}\n')
            ficheroError.close()
            
    print(f'Total insertados: {insertados}')
    print(f'Total rechazados: {rechazados}')
            
except mysql.connector.IntegrityError as e:
    print(f'Integrity Error: {e}')

finally:
    if cursor:
        cursor.close()
    if conexion and conexion.is_connected():
        conexion.close()