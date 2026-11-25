import mysql.connector

try:
    conexion = mysql.connector.connect(
        user = 'miuu',
        password = 'daw2007_2',
        host = 'localhost',
        database = 'ordenadores',
        port = '41064'
    )

    cursor = conexion.cursor()

    sql_create_clientes = "create table if not exists clientes (nombre varchar(50), direccion varchar(200))"

    sql_create_empleados = "create table if not exists empleados (id int auto_increment primary key, nombre vrachra(255), puesto varchar(2100))"

    cursor.execute(sql_create_clientes)
    cursor.execute(sql_create_empleados)
    conexion.commit()

    cursor.execute("show tables")
    for tables in cursor:
        print(tables)

except mysql.connector.Error as error:
    print(f"Error: {error}")