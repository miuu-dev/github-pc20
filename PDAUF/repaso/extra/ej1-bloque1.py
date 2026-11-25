# definir una función
def modificar_datos(numero, lista):
    print(f'Dentro (antes de sumar) - id(numero): {id(numero)}')
    numero += 10
    print(f'Dentro (después de sumar) - id(numero): {id(numero)} | numero = {numero}\n')
    
    lista.append(10)
    print(f'Dentro (antes de sumar) - id(lista): {id(lista)}')
    print(f'Dentro (después de sumar) - id(lista): {id(lista)} | lista = {lista}')

# codigo principal
n = 5
l = []
modificar_datos(n, l)