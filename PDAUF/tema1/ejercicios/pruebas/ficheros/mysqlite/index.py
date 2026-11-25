import sqlite3

miConexion = sqlite3.connect("MiBase")
miCursor = miConexion.cursor()

# miCursor.execute("create table productos (nombre_articulo varchar(50), precio integer, seccion varchar(50))")

# miCursor.execute("insert into productos values ('Balón', 15, 'Deportes')")
# masProductos = [
#         ("Camiseta", 12, "Moda"),
#         ("Squishy", 2, "Juguete"),
#         ("Lámpara", 8, "Decoración"),
#         ("Sofá", 85, "Mueble"),
# ]

# miCursor.executemany("insert into productos values (?,?,?)", masProductos)

# miCursor.execute("select * from productos")

# misProductos = miCursor.fetchall()
# print(misProductos)
# for producto in misProductos:
#     print(producto)
# print("")
# for producto in misProductos:
#     print("\nNombre del artículo: ", producto[0], 
#             "\n Precio: ", producto[1], "€\n " \
#             "Sección: ", producto[2])



miConexion.commit()

miCursor.close()
miConexion.close()