# ~~ PARTE 1 ~~
fichero = open('diario.txt', 'rt', encoding='utf-8')

fichero.seek(7)
print(fichero.readline())
# leyó desde el espacio que hay entre el : y Salí

fichero.close()

# ~~ PARTE 2 ~~
fichero = open('diario.txt', 'r+', encoding='utf-8')

print(fichero.readlines())
fichero.write('\nDía 5: Acepté la misión del herrero. \n')

fichero.close()
