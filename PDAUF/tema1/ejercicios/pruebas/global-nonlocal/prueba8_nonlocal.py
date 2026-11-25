def subrutina():
    def sub_rutina():
        nonlocal a 
        # indicamos que no debe buscar una variable a en local
        # sino que debe buscarlo en un ámbito superior que
        # es subrutina
        print(a)
        a = 1
        return

    a = 3 # variable local que depende de subrutina()
    sub_rutina()
    print(a)
    return

a = 4 # variable global
subrutina()
print(a)