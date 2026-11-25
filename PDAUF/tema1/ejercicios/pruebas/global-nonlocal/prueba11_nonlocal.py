def funcion_externa():
    mensaje = "Hola"  # Variable de la función externa

    def funcion_interna():
        nonlocal mensaje
        mensaje = "Hola, Miuu"  # Modifica la variable de la función externa
        print(f"Dentro de la interna: {mensaje}")

    funcion_interna()
    print(f"Fuera de la interna: {mensaje}")

funcion_externa()