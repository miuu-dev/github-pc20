# clase PADRE
from abc import ABC, abstractmethod
import math

class FiguraGeometrica(ABC): # indicamos que es una clase abstracta
    @abstractmethod
    def calcular_area(self):
        pass

# clases HIJA
class Circulo(FiguraGeometrica):
    def __init__(self, radio):
        self.radio = radio

    def calcular_area(self):
        return math.pi * (self.radio * 2)


class Rectangulo(FiguraGeometrica):
    def __init__(self, ancho, largo):
        self.ancho = ancho
        self.largo = largo

    def calcular_area(self):
        return self.ancho * self.largo


# método externo 
# type(figura).__name__ → nos dice el tipo de objeto al que fue aplicado → círculo o rectángulo
def imprimir_area(figura):
    print(f'El área de {type(figura).__name__} es: {figura.calcular_area():.2f}')
        

# programa principal
# figura = FiguraGeometrica() → da error porque no se puede crear un objeto de un método abstracto
c = Circulo(2.5)
r = Rectangulo(2, 5)

imprimir_area(c)
imprimir_area(r)