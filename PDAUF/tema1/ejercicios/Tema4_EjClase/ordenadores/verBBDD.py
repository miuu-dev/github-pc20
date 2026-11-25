import mysql.connector

try:
    conexion = mysql.connector.connect(
        user = 'miuu',
        password = 'daw2007_2',
        host = 'localhost',
        port = '41064'
    )

    cursor = conexion.cursor()

    cursor.execute("show databases")

    for bd in cursor:
        print(bd)

except mysql.connector.Error as error:
    print(f"Error: {error}")