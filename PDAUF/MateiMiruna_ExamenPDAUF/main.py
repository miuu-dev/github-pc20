from perro import Perro

# 1. todos los perros de la BBDD ordenadas por peso
listaPerros = Perro.obtenerTodos()

# 2. hembra a cruzar
perra  = Perro.obtenerHembra(listaPerros)

# 3. Pareja más afín
pareja = perra.obtenerParejaMasAfin(listaPerros)

# 4. cruce (actualiza la BBDD: alta del cachorro y +1 hijo a padre y madre)
cachorro = pareja.cruzar(pareja)

# 5. informe
nombre_fichero = 'matei'
Perro.crearInformeTxt(nombre_fichero)


# funciona todo , pero falla perra = Perro.obtenerHembra(listaPerros)