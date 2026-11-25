# clase PADRE
class Vehiculo:
    # constructor
    def __init__(self, marca, modelo):
        self.__marca = marca
        self.__modelo = modelo

    # método
    def estado(self):
        print(f'Marca: {self.__marca} || Modelo: {self.__modelo}')

# clase HIJA
class Camion(Vehiculo):
    # constructor
    def __init__(self, marca, modelo, capacidad_carga):
        super().__init__(marca, modelo)
        self.capacidad_carga = capacidad_carga

    def estado(self):
        super().estado()
        print(f'Capacidad de carga: {self.capacidad_carga}')

# programa principal
# creamos un objeto de cada uno
vehiculo = Vehiculo('KIA', 'Speed') 
camion = Camion('KIA', 'Slow', '5000')

vehiculo.estado()
print('---')
camion.estado()