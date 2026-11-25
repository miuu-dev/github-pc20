# función solicitante
def solicitante():
    numPares = 0
    testigo = False

    while True:
        try:
            num = int(input("Ingrese un número: "))

            if num % 2 == 0:
                numPares += 1

            if num == 0:
                testigo = True
                break

        except ValueError:
            print("Error: Invalid value provided.")

    print(f"Cantidad de números pares: {numPares}")
    print(f"Testigo: {testigo}")

# llamamos a la función
solicitante()