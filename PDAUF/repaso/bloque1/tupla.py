# count
mi_tupla = (1,2,1,1,1,3,4)
repetido = mi_tupla.count(1)
print(f'La tupla: {mi_tupla}')
print(f'¿Cuántas veces aparece el \'1\'? {repetido} \n')

# index
mi_tupla2 = (7, 7, 7, 3, 5, 7, 7)
posicion = mi_tupla2.index(7, 3) # buscar 7 a partir de la posición 3
print(f'La tupla: {mi_tupla2}')
print(f'El primer \'7\' que aparece después de la posición \'3\' está en: {posicion}')