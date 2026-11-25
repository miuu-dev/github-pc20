def recorrer(lista):
    for elemento in lista:
        print(elemento)

lista = ['Albacete', 1940, 'Goles', 66, True]

# recorremos de forma normal la lista
# recorrer(lista)

# juntamos un nuevo dato
# lista.append('Juntar con un nuevo dato')
# recorrer(lista)

# sale al revés
# lista.reverse()
# recorrer(lista)

# indicamos la posición en la que queremos que se añada el dato
# lista.insert(1, 'Carlos Belmonte')
# recorrer(lista)

# muestra solo del caracter 1 al 4 (sin incluirlos)
recorrer(lista[1:4])