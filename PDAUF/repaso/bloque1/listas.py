# AÑADIR E INSERTAR
# append → añade al final
frutas = ['manzana', 'pera']
print(f'Frutas sin plátano: {frutas}')
frutas.append('plátano')
print(f'Frutas con plátano: {frutas} \n')

# insert → inserta en el índice que le indiquemos
numeros = [3, 5]
print(f'Lista sin el 20: {numeros}')
numeros.insert(1, 20)
print(f'Lista con el 20: {numeros} \n')

# extend → unimos 2 listas
mochila = ['Poción', 'Mapa']
botin = ['Escudo', 'Moneda']
mochila.extend(botin)
print(f'Mochila extendida: {mochila} \n')


# ELIMINAR
# pop → elimina y devuelve la posición elegida
letras = ['a', 'b', 'c']
print(f'Lista letras: {letras}')
eliminado = letras.pop(1)
print(f'Eliminado: {eliminado}')
print(f'Lista letras: {letras} \n')

# remove → borra el primero que encuentre del dato que le hemos indicado
nombres = ['Miruna', 'Javier', 'Miruna']
print(f'Nombres: {nombres} ')
nombres.remove('Miruna')
print(f'Nombres: {nombres} \n')

# clear → lo vacía
datos = [1,2,3,4,5]
print(f'Datos: {datos} ')
datos.clear()
print(f'Datos: {datos} \n')


# BÚSQUEDA Y ORDENACIÓn
# reverse → al revés
num = [1,2,3,4,6,747,21,4124,0]
print(f'Lista num: {num}')
num.reverse()
print(f'Lista num al revés: {num} \n')

# sort → los ordena de menor a mayor
loteria = [9,10,11,65,3]
loteria.sort()
print(f'Loteria ordenada: {loteria} \n')

# index → muestra el índice en el que se encuentra el dato requerido
colores = ['rojo', 'verde']
indice = colores.index('rojo')
print(f'Indice en el que se encuentra \'rojo\': {indice} \n')

# count → cuentas las veces que salió el dato elegido
notas = [5,2,6,5,5,10]
print(f'¿Cuántas veces sale el 5? {notas.count(5)} \n')


# COPIA
# copy
original = [7,8,9,1] 
copia = original.copy() 
print(f'Copia del original: {copia}')
copia.append(4) 
print(f'Copia +4: {copia}') 
print(f'Original +4: {original} \n') 