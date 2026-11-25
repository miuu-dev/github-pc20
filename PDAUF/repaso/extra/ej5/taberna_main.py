import mysql.connector

def conexion_bd():
    return mysql.connector.connect(
        host="127.0.0.1",
        user="miuu",
        password="daw2007_2",
        database="taberna",
        port=41064
    )
    
def crear_tabla():
    conexion = conexion_bd()
    cursor = conexion.cursor()
    sql_create = '''
        create table if not exists carta (
            id integer primary key auto_increment,
            producto varchar(100) unique,
            precio integer,
            existencias integer
        )
    '''
    cursor.execute(sql_create)
    conexion.commit()
    print(f'Tabla carta creada correctamente')

def carga_e_importacion():
    conexion = None 
    cursor = None
    
    try: 
        # abrimos carta.txt e insertamos datos
        carta = open('carta.txt', 'w', encoding='utf-8')
        carta.write('Cerveza de miel;2;50\n')
        carta.write('Estofado de jabalí;5;20\n')
        carta.write('Pan de centeno;1;40\n')
        carta.write('Vino élfico;8;10\n')
        carta.write('Queso de cabra;3;15\n')
        carta.close()
        
        # conectamos con bbdd
        conexion = conexion_bd()
        cursor = conexion.cursor()
        
        # crear tabla
        crear_tabla()
        
        # leer lineas del fichero
        # 2. Abrir en modo lectura ('r') para leer las líneas
        carta = open('carta.txt', 'r', encoding='utf-8')
        lineas = carta.readlines()
        carta.close()
        
        insertados = 0
        rechazados = 0
        # insertar a la bbdd
        for linea in lineas:
            linea = linea.strip()
            if not linea:
                continue
            datos = linea.split(';')
            producto = datos[0]
            precio = int(datos[1])
            existencias = int(datos[2])
            
            sql_insert = 'insert into carta (producto, precio, existencias) values (%s, %s, %s)'
            valores = (producto, precio, existencias)
            
            try:
                cursor.execute(sql_insert, valores)
                conexion.commit()
                insertados += 1
            except mysql.connector.IntegrityError:
                rechazados += 1
                
        print(f'Carga inicial completada ({insertados} productos nuevos insertados).')
        print(f'Carga inicial completada ({rechazados} productos rechazados).')
        
    except mysql.connector.IntegrityError as e:
        print(f'Error: {e}')
        
    finally:
        if cursor:
            cursor.close()
            
        if conexion and conexion.is_connected():
            conexion.close()

# opción 1
def carta_completa():
    conexion = None
    cursor = None
    
    try:
        # conectamos con bbdd
        conexion = conexion_bd()
        cursor = conexion.cursor()
        sql_select = 'select * from carta'
        cursor.execute(sql_select)
        registros = cursor.fetchall()
        
        print('\n---- CARTA DE LA TABERNA ----')
        for id, producto, precio, existencias in registros:
            print(f'ID: {id} | Producto: {producto} | Precio: {precio:.2f} | Existencias: {existencias}')
        print('------------------------------')
        
        conexion.commit()
    except mysql.connector.IntegrityError as e:
        print(f'Error: {e}')
    finally:
        if cursor:
            cursor.close()
        if conexion and conexion.is_connected():
            conexion.close()

# opción 2
def anadir_producto():
    conexion = None
    cursor = None
    try:
        producto = input("Nombre del producto: ").strip()
        precio = float(input("Precio del producto: "))
        existencias = int(input("Existencias: "))
        
        valores = (producto, precio, existencias)
        
        # conectamos
        conexion = conexion_bd()
        cursor = conexion.cursor()
        
        # insertamos
        sql_insert = 'insert into carta (producto, precio, existencias) values (%s, %s, %s)'
        cursor.execute(sql_insert, valores)
        conexion.commit()
        
        if cursor.rowcount > 0:
            print(f'Producto {producto} ha sido ingresado correctamente')
        else:
            print('No se pudo ingresar el producto')
            
    except mysql.connector.Error as e:
        print(f'Error: {e}')
    finally:
        if cursor:
            cursor.close()
        if conexion and conexion.is_connected():
            conexion.close()

# opción 3
def cambiar_precio():
    conexion = None
    cursor = None
    try:
        id_producto = int(input("ID del producto: "))
        precio = float(input("Nuevo precio: "))
        
        # conectamos
        conexion = conexion_bd()
        cursor = conexion.cursor()
        
        valores = (precio, id_producto)
        
        # actualizamos
        sql_update = 'update carta set precio = %s where id = %s'
        cursor.execute(sql_update, valores)
        conexion.commit()
        
        if cursor.rowcount > 0:
            print(f'ID {id_producto} ha sido actualizado correctamente')
        else:
            print('No se pudo actualizar el producto')
    except mysql.connector.Error as e:
        print(f'Error: {e}')
    finally:
        if cursor:
            cursor.close()
        if conexion and conexion.is_connected():
            conexion.close()

# opción 4
def retirar_producto():
    conexion = None
    cursor = None
    try:
        id_producto = int(input("ID del producto a retirar: "))
        
        # conectamos
        conexion = conexion_bd()
        cursor = conexion.cursor()

        cursor.execute('delete from carta where id = %s', (id_producto,))
        conexion.commit()
                
        if cursor.rowcount > 0:
            print(f'Producto con ID {id_producto} retirado de la carta.')
        else:
            print(f'No se encontró ningún producto con el ID {id_producto}.')
    except mysql.connector.IntegrityError as e:
        print(f'Error: {e}')
    finally:
        if cursor:
            cursor.close()
        if conexion and conexion.is_connected():
            conexion.close()
            
# opción 5
def productos_pocas_existencias():
    conexion = None
    cursor = None
    try:
        # conectamos
        conexion = conexion_bd()
        cursor = conexion.cursor()
        
        # sql
        sql_select = 'select * from carta where existencias < 15'
        cursor.execute(sql_select)
        registros = cursor.fetchall()
        
        print('\n---- PRODUCTOS CON MENOS DE 15 EXISTENCIAS ----')
        if not registros:
            print('Todos tienen más de 15 existencias')
        for id, producto, precio, existencias in registros:
            print(f'ID: {id} | Producto: {producto} | Precio: {precio} | Existencias: {existencias}')
    except mysql.connector.IntegrityError as e:
        print(f'Error: {e}')
    finally:
        if cursor:
            cursor.close()
        if conexion and conexion.is_connected():
            conexion.close()
            
# opción 6
def guardar_copia():
    conexion = None
    cursor = None
    try:
        # conectamos
        conexion = conexion_bd()
        cursor = conexion.cursor()
        cursor.execute('select producto, precio, existencias from carta')
        registros = cursor.fetchall()
        
        copia = open('carta_copia.txt', 'w', encoding='utf-8')
        for producto, precio, existencias in registros:
            copia.write(f'{producto};{precio};{existencias}\n')
        copia.close()
        
        print('Copia de seguridad realizada con éxito en \'carta_copia.txt\'')
    except mysql.connector.IntegrityError as e:
        print(f'Error: {e}')
    finally:
        if cursor:
            cursor.close()
        if conexion and conexion.is_connected():
            conexion.close()
            
# menú
def menu():
    carga_e_importacion()
    opcion = ""
    while opcion != "7":
        print('\n=== GESTIÓN DE LA TABERNA ===')
        print('1. Ver la carta completa')
        print('2. Añadir un producto nuevo')
        print('3. Cambiar el precio de un producto')
        print('4. Retirar un producto por su ID')
        print('5. Ver productos con menos de 15 existencias')
        print('6. Guardar copia de la carta en carta_copia.txt')
        print('7. Salir')
        
        opcion = input("Selecciona una opción: ").strip()
        
        if opcion == "1":
            carta_completa()
        elif opcion == "2":
            anadir_producto()
        elif opcion == "3":
            cambiar_precio()
        elif opcion == "4":
            retirar_producto()
        elif opcion == "5":
            productos_pocas_existencias()
        elif opcion == "6":
            guardar_copia()
        elif opcion == "7":
            print("Cerrando la taberna...")
        else:
            print('Opción no válida, vuelve a intertarlo')
        
if __name__ == '__main__':
    menu()