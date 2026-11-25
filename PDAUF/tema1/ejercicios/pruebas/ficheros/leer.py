# Forma de trabajar con ficheros: 1) Se abre el fichero ; 2) se trabaja con el fichero. 3) se cierra el fichero
fichero = open('./prueba.txt','rt', encoding='utf-8') #es igual que fichero = open ('./prueba.txt')

primeraLinea = fichero.readline()
print("Primera línea: ", primeraLinea)

segundaLinea = fichero.readline()
print("Segunda línea: ", segundaLinea)

terceraLinea = fichero.readline()
print("Tercera línea: ", terceraLinea)

cuartaLinea = fichero.readline()
print("Cuarta línea: ", cuartaLinea)

# todasLasLineas = fichero.readlines()
# print("Todas las líneas: ", todasLasLineas)

# cerrar fichero
fichero.close()