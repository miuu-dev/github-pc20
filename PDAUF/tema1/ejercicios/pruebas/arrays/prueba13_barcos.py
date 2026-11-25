import random

filas = 10
columnas = 15

# declaramos nuestro array
tablero = []

# creamos un bucle for en un rango indicando las filas para repetir ese bucle exactamente el número de veces definido en filas para asegurarnos que hay 10 filas en el tablero
for barco in range(filas):
    fila = ['-'] * columnas
    tablero.append(fila) 

# colocamos los barcos con los nuevos límites
# decimos que empiece en la posición cero y termine en las filas indicadas -1 para que no sobrepase
barco_fila = random.randint(0, filas - 1)
barco_columna = random.randint(0, columnas - 1)

# creamos una función para mostrar como va la tabla
# def mostrar_tablero(tabla): 


# ahora creamos un bucle while a tiempo real para que el juego no termine hasta que el usuario encuentre el barco
while True:
    print("--- HUNDIR LA FLOTA ---")
    # métemos la petición
    print("\nIntroduce las coordenadas de disparo: ")
    
    # pedimos al usuario que introduzca un número para la fila y columna
    fila_user = int(input("Elige una fila de 0 a 9: "))
    columna_user = int(input("Elige una columna de 0 a 14: "))


    # creamos ahora un bucle if ... else para comprobar si los datos que ha metido el usuario han dado con el barco o no
    if (fila_user == barco_fila and columna_user == barco_columna):
        print('0 -> ¡HUNDIDO! Has encontrado el barco hundido')
        tablero[fila_user][columna_user] = 'X' # indicamos que en la posición que nos dijo el usuario es una X de hundido
        break # damos a entender que termina el bucle

    else:
        print('1 -> ¡AGUA! No encontrado el barco hundido')
        tablero[fila_user][columna_user] = 'O' # indicamos que en la posición que nos dijo el usuario es un O porque dio en el agua 
