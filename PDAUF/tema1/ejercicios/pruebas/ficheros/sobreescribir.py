fichero = open('./prueba2.txt', 'w', encoding='utf-8')
fichero.write("Esta linea se añadirá al final del fichero\n")
listaLineas = [
    "esta es la primera línea del texto\n",
    "añadimos otra línea de texto\n",
    "añadimos otra más para continuar añadiendo texto\n",
    "y aquí se acaba todo\n"
]

fichero.writelines(listaLineas)
fichero.write("Esta linea se añadirá al final del fichero nuevamente\n")


fichero.close()