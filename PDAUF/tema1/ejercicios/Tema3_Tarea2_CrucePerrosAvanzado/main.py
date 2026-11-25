from tema1.ejercicios.Tema3_Tarea2_CrucePerrosAvanzado.perro import Perro



# PRIMERO: instanciamos los objetos a usar con los métodos
macho1 = Perro("Labrador", "Negro", 9, 3, "macho")
macho2 = Perro("Pastor Alemán", "Marrón", 13, 2, "macho")
hembra1 = Perro("Beagle", "Tricolor", 5, 4, "hembra")
hembra2 = Perro("Husky", "Negro con blanco", 4, 3, "hembra")



# SEGUNDO: creamos los cruces 
print("---- REALIZAMOS LOS CRUCES ----")
# macho + hembra
cachorro1 = Perro.cruzar(macho1, hembra1)
if cachorro1 is not None:
    print("Cachorro 1: ", cachorro1.raza, cachorro1.color, cachorro1.peso, cachorro1.edad, cachorro1.sexo)

# macho + macho
cachorro2 = Perro.cruzar(macho1, macho2)
if cachorro2 is not None:
    print("Cachorro 2: ", cachorro2.raza, cachorro2.color, cachorro2.peso, cachorro2.edad, cachorro2.sexo)

# hembra + hembra
cachorro3 = Perro.cruzar(hembra1, hembra2)
if cachorro3 is not None:
    print("Cachorro 3: ", cachorro3.raza, cachorro3.color, cachorro3.peso, cachorro3.edad, cachorro3.sexo)

# hembra + macho
cachorro4 = Perro.cruzar(hembra2, macho2)
if cachorro4 is not None:
    print("Cachorro 4: ", cachorro4.raza, cachorro4.color, cachorro4.peso, cachorro4.edad, cachorro4.sexo, "\n")



# TERCERO: obtenemos las hembras
print("---- OBTENEMOS LAS HEMBRAS ----")
lista1 = [macho1, hembra1]
lista2 = [macho2, hembra2]

hembras = Perro.obtenerHembras(lista1, lista2)
for h in hembras:
    print("Hembra: ", h.raza, h.color)


# CUARTO: buscamos la pareja más adecuada
print("\n---- PAREJA MÁS A FIN ----")
listaPerros = [macho1, macho2, hembra1, hembra2]
for perro in listaPerros:
    parejaIdeal = perro.obtenerParejaMasAfin(listaPerros)
    if parejaIdeal:
        print(
            f"A {perro.raza} ({perro.sexo}) le ha tocado como pareja ideal:"
            f" {parejaIdeal.raza}, {parejaIdeal.peso} kg"
        )
    else:
        print(
            f"No se ha encontrado ninguna pareja compatible para el/la {perro.raza}."
        )