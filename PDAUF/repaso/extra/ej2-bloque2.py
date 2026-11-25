# importar abc y abstractmethod
from abc import ABC, abstractmethod

#crear la clase abstracta personaje
class Personaje(ABC):
    # constructor
    def __init__(self, nombre):
        self.nombre = nombre
        self.nivel = 1
        self.vida = 100
        self.inventario = []

    # método abstracto
    @abstractmethod
    def atacar(self, objetivo):
        pass


# clases hijas
class Mago(Personaje):
    # constructor
    def __init__(self, nombre):
        super().__init__(nombre)
        self.inteligencia = 100

    def atacar(self, objetivo):
        dano = self.inteligencia * 0.6
        objetivo.vida = max(0, objetivo.vida - dano)
        return dano


class Guerrero(Personaje):
    # constructor
    def __init__(self, nombre):
        super().__init__(nombre)
        self.fuerza = 75

    def atacar(self, objetivo):
        dano = self.fuerza * 0.8
        objetivo.vida = max(0, objetivo.vida - dano)
        return dano


# programa principal
# p = Personaje("Merlín") → da error porque no podemos instanciar un objeto desde la clase abstracta
mago = Mago("Merlín")
guerrero = Guerrero("He-Man")

print(f'MAGO: {mago.nombre} | Vida: {mago.vida} | Inteligencia: {mago.inteligencia}')
print(f'GUERRERO: {guerrero.nombre} | Vida: {guerrero.vida} | Fuerza: {guerrero.fuerza}')

dano = mago.atacar(guerrero)
print(f'\nDaño realizado: {dano}')
print(f'MAGO: {mago.nombre} | Vida: {mago.vida} | Inteligencia: {mago.inteligencia}')
print(f'GUERRERO: {guerrero.nombre} | Vida: {guerrero.vida} | Fuerza: {guerrero.fuerza}')