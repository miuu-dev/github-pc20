contador = 0

def incrementar():
    global contador
    contador += 1
    print(f"Dentro de la función: {contador}")

incrementar()
print(f"Fuera de la función: {contador}")