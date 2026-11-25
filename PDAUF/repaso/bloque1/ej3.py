# definir función
def modificar(num, lista):
    num += 5
    lista.append(5)

# definir fuera de la función
n = 10
li = [25]
modificar(n, li)

# mostrar cambios
print(n) # imprime 10 porque n es inmutable (no modificable)
print(li) # imprime [25, 5] porque una lista sí es mutable (modificable)