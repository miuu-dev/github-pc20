import mysql.connector
# importación navegando por el paquete y módulo mediante puntos
from modelo.cliente import ClienteVIP


# 1. configuración de la conexión a MySQL en phpMyAdmin
def conectar_bd():
    return mysql.connector.connect(
        host="127.0.0.1",
        user="miuu",
        password="dawdaw123",
        database="tienda",
        port=41064
    )


# 2. Bloque 3 + Bloque 1: importar fichero.txt a la BBDD en phpMyAdmin
def cargar_fichero(nombre_archivo):
    conexion = None
    insertados = 0
    rechazados = 0

    try:
        # abrimos el fichero
        fichero = open(nombre_archivo, 'r+', encoding='utf-8')
        lineas = fichero.readlines()
        fichero.close()

        conexion = conectar_bd()
        cursor = conexion.cursor()

        for linea in lineas:
            linea = linea.strip()
            if not linea:
                continue

            # fragmentación de campos por delimitador
            nombre, email, edad, saldo = linea.split(';')

            # instanciación del objeto con conversiones de tipo
            cliente = ClienteVIP(nombre.strip(), email.strip(), int(edad), float(saldo))

            sql_insert = 'insert into clientes (nombre, email, edad, saldo) values (%s, %s, %s, %s)'
            valores = (cliente.nombre, cliente.email, cliente.obtener_edad(), cliente.saldo)

            try:
                cursor.execute(sql_insert, valores)
                insertados += 1
            except mysql.connector.Error:
                # captura de duplicados en campos UNIQUE
                rechazados += 1

        conexion.commit()  # confirmación obligatoria de cambios en disco
        print(f'\n--- Carga completada: {insertados} insertados, {rechazados} rechazados')

    except FileNotFoundError as e:
        print(f'Error: {e}')
    except mysql.connector.Error as err:
        print(f'Error de base de datos: {err}')
    finally:
        if conexion and conexion.is_connected():
            conexion.close()


# 3. consultar y mostrar todos los clientes de la BBDD (read)
def listar_clientes():
    conexion = None
    try:
        conexion = conectar_bd()
        cursor = conexion.cursor()
        cursor.execute('select * from clientes')
        registros = cursor.fetchall()

        print('\n------ LISTADO DE CLIENTES ------')
        for registro in registros:
            id_c, nombre, email, edad, saldo = registro
            # instanciamos el objeto desde la tupla devuelta por la BBDD
            cliente = ClienteVIP(nombre, email, edad, saldo)
            print(f'ID {id_c}: {cliente.mostrar_info()}')
        print('\n------------------------------------')
    except mysql.connector.Error as err:
        print(f'Error: {err}')
    finally:
        if conexion and conexion.is_connected():
            conexion.close()


# 4. Exportar los datos de MySQL a un informe formateado en .txt
def exportar_informe():
    conexion = None
    try:
        conexion = conectar_bd()
        cursor = conexion.cursor()
        cursor.execute('select nombre, email, edad, saldo from clientes')
        registros = cursor.fetchall()

        informe = open('informe_clientes.txt', 'w', encoding='utf-8')
        informe.write('INFORME GENERAL DE CLIENTES Y SALDO\n')
        informe.write('---------------------------------------------\n\n')

        total_saldo = 0.0
        for registro in registros:
            nombre, email, edad, saldo = registro
            total_saldo += float(saldo)
            informe.write(f'Clientes: {nombre} | Email: {email} | Edad: {edad} | Saldo {saldo:.2f}€\n')

        informe.write('\n---------------------------\n')
        informe.write(f'Total de clientes registrados: {len(registros)}\n')
        informe.write(f'Saldo total acumulado: {total_saldo:.2f}€\n')
        informe.close()

        print('\nInforme generado con éxito en \'informe_clientes.txt\'')
    except mysql.connector.Error as err:
        print(f'Error: {err}')
    finally:
        if conexion and conexion.is_connected():
            conexion.close()


# 5. bloque 1: menú interactivo principal
def menu():
    opcion = ""
    while opcion != "5":
        print("\n--- GESTIÓN DE TIENDA (PRACTICA BLOQUES 1, 2 Y 3) ---")
        print("1. Cargar clientes desde fichero 'datos_clientes.txt'")
        print("2. Listar clientes de phpMyAdmin")
        print("3. Añadir cliente manualmente")
        print("4. Exportar informe a archivo de texto")
        print("5. Salir")

        opcion = input("Selecciona una opción: ").strip()

        if opcion == "1":
            cargar_fichero("datos_clientes.txt")
        elif opcion == "2":
            listar_clientes()
        elif opcion == "3":
            try:
                nombre = input("Nombre: ").strip()
                email = input("Email: ").strip()
                edad = int(input("Edad: "))
                saldo = float(input("Saldo: "))
            except ValueError:
                print("Error: La edad debe ser un número entero y el saldo un número válido.")
                continue

            cliente = ClienteVIP(nombre, email, edad, saldo)
            conexion = None
            try:
                conexion = conectar_bd()
                cursor = conexion.cursor()
                cursor.execute(
                    'insert into clientes (nombre, email, edad, saldo) values (%s, %s, %s, %s)',
                    (cliente.nombre, cliente.email, cliente.obtener_edad(), cliente.saldo)
                )
                conexion.commit()
                print(f'Cliente {cliente.nombre} insertado con éxito')
            except mysql.connector.Error as err:
                print(f'Error: {err}')
            finally:
                if conexion and conexion.is_connected():
                    conexion.close()

        elif opcion == "4":
            exportar_informe()
        elif opcion == "5":
            print("Saliendo del programa...")
        else:
            print("Opción no válida. Inténtalo de nuevo")


if __name__ == '__main__':
    menu()