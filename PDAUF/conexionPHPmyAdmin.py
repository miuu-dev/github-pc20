import mysql.connector

try:
    conextion = mysql.connector.connect(
        host = "127.0.0.1",
        user = "miuu",
        password = "daw2007_2",
        database = "dbconducir",
        port = 41064
    )

    if conextion.is_connected():
        print("Conexión existosa")
        conextion.close()

except mysql.connector.Error as error:
    print(f"Error: {error}")