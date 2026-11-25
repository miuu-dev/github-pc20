fichero = open('diario.txt', 'rt', encoding='utf-8')

primeraLinea = fichero.readline()
resto = fichero.readlines()

fichero.close()
print(primeraLinea, end='')
print(resto, end='')

print('\nNúmero de líneas de la lista "resto": ', len(resto))

# No son 4 líneas porque en el array resto tenemos las tres últimas líneas capturadas, mientras que en primeraLinea, por haber puesto readLinea(), solo lee la primera línea que encuentra si no fue leída 