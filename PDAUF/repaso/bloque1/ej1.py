try:
    # pedir dos números enteros al usuario
    a = int(input("Ingrese el primer número: "))
    b = int(input("Ingrese el segundo número: "))

    # intercambia los valores de a y b
    temp = a
    a = b
    b = temp

    # condicionales
    if a > b: 
        print("A es mayor")
    else: 
        print("B es mayor o igual")

except ValueError:
    print("Error: Debe ingresar números enteros.")