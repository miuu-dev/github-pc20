fichero = open('./diario.txt', 'rt', encoding='utf-8') # esto nos ayuda a abrir el fichero que con los permisos de abrir para leer el texto

print(fichero.readline(), end='') # este último significa salto de línea
print(fichero.readline(), end='') 

fichero.close()