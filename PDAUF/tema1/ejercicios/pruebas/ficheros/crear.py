try:
    fichero = open('./prueba3.txt', 'x', encoding='utf-8')
    fichero.write('Probando la creación de ficheros con modo x')

    # métodos para comprobar si podemos leer o escribir un fichero
    print("Ha sido creado el fichero con éxito")
    print('Podemos leer el fichero? ', fichero.readable())
    print('Podemos escribir en el fichero? ', fichero.writable())

    fichero.close()

except FileExistsError:
    print('No podemos volver a crear un fichero que ya existe')


# try:
#     fichero = open('prueba.txt', 'x', encoding='utf-8')
#     fichero.write('Porbando la creación de ficheros con modo x')

#     # métodos para comprobar si podemos leer o escribir un fichero
#     print('Podemos leer el fichero? ', fichero.readable())
#     print('Podemos escribir en el fichero? ', fichero.writable())

#     fichero.close()

# except FileExistsError:
#     print('No podemos volver a crear un fichero que ya existe')