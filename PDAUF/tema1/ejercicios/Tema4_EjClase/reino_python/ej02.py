fichero = open('./diario.txt', 'rt', encoding='utf-8') # esto nos ayuda a abrir el fichero que con los permisos de abrir para leer el texto
lineas = fichero.readlines()
fichero.close()

print(lineas)

for linea in lineas:
    print(">> " + linea.strip()) # pegamos el >> al principio de cada líneas