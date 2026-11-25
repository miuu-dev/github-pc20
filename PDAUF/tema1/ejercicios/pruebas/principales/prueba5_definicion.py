'''
def subrutina():
    print(a)
    return

a = 10
subrutina()
'''


# Definición con variable GLOBAL
def subrutina2():
    global a
    print(a)
    a = 1
    return

a = 5
subrutina2()
print(a)  # Imprime 1, porque la variable a es global y
# se ha modificado dentro de la función
