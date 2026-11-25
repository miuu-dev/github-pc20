import sqlite3

conexion = None
cursor = None
fichero = None

try:
    # 1. conectarse a la bbdd
    conexion = sqlite3.connect('Bestiario.db')
    cursor = conexion.cursor()
    
    # 1.1. hacer un select completo
    query = 'select * from monstruos'
    cursor.execute(query)
    
    # 2. abre/crea un fichero en modo w
    fichero = open('./informe_bestiario.txt', 'w', encoding='utf-8')
    
    # 3. escribir cabecera
    fichero.write('--- MONSTRUOS ---\n\n')
    
    # 3.1. recorrer las tuplas devueltas por fetchall()
    datos = cursor.fetchall()
    
    contador = 0
    acumulador = 0
    
    # 3.2. escribir de forma formateada
    for dato in datos:
        nombre = dato[1]
        tipo = dato[2]
        vida = int(dato[3])
        recompensa = int(dato[4])
        
        contador += 1
        acumulador += recompensa
        
        fichero.write(f'{contador}. {nombre} - {tipo} - Vida: {vida} - Oro: {recompensa}\n')
        
    
    # 5. añadir footer
    fichero.write(f"\n---------------------------\nTotal de criaturas: {contador}\nOro total en recompensa: {acumulador}")

except sqlite3.IntegrityError as e:
    print(f'Error: {e}')
    
finally:
    if fichero:
        fichero.close()
        
    if cursor:
        cursor.close()
        
    if conexion:
        conexion.close()