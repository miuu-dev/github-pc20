# Creamos la clase PADRE
class Vehiculo():
    def __init__(self, marca, modelo):
        self.marca = marca 
        self.modelo = modelo 
        self.enmarcha = False 
        self.acelera = False 
        self.frena = False 

    # ponemos los que están False a True
    def arrancar(self):
        self.enmarcha = True 

    def acelerar(self):
        self.acelera = True 

    def frenar(self):
        self.frena = True

    # mostramos el estado del vehículo. De NORMAL no tiene print, pero al ser una prueba, nos lo permitimos
    def estado(self):
        print(
            "Marca: ", self.marca, 
            "\nModelo: ", self.modelo, 
            "\nEn marcha: ", self.enmarcha, 
            "\nAcelerando: ", self.acelera, 
            "\nFrenando: ", self.frena
        )



# Creamos la clase HIJA
# Camión hereda de clase Vehiculo
class Camion(Vehiculo):
    
    def __init__(self, marca, modelo, descargando):
        super().__init__(marca, modelo)
        self.descargando = descargando

    # def estado(self):
    #     print(
    #         "Marca: ", self.marca, 
    #         "\nModelo: ", self.modelo, 
    #         "\nEn marcha: ", self.enmarcha, 
    #         "\nAcelerando: ", self.acelera, 
    #         "\nFrenando: ", self.frena,
    #         "\nDescargando: ", self.descargando
    #     )

    def estado(self):
        super().estado()
        print("Descargando: ", self.descargando)

    def moverse(self):
        print("Este camión se mueve con 8 ruedas")



# Creamos la clase HIJA
# Camión hereda de clase Vehiculo
class Moto(Vehiculo):
    
    def __init__(self, marca, modelo):
        super().__init__(marca, modelo)

    def estado(self):
        super().estado()

    def moverse(self):
        print("Esta moto se mueve con 2 ruedas")




# Esto sería como la clase principal
# POLIMORFISMO
def moverVehiculo(Vehiculo): # le ponemos Vehículo porque es la clase MÁS general
    Vehiculo.moverse() # tiene que estar este método en TODAS las clases HIJAS
print("\n--- DATOS DEL CAMIÓN ---")
miCamion = Camion("Volvo", "FMX", "Estoy descargando lentamente")
miCamion.estado()

print("\n¿Es miCamion instancia de Vehiculo?", isinstance(miCamion, Vehiculo))
print("¿Es miCamion instancia de Camion?", isinstance(miCamion, Camion))

print("")
miCamion.moverse()


print("\n--- DATOS DE LA MOTO ---")
miMoto = Moto("Kawasaki", "Rojo")
miMoto.estado()

print("\n¿Es miMoto instancia de Vehiculo?", isinstance(miMoto, Vehiculo))
print("¿Es miMoto instancia de Camion?", isinstance(miMoto, Camion))
print("¿Es miMoto instancia de Moto?", isinstance(miMoto, Moto))

print("")
miMoto.moverse()
print("")