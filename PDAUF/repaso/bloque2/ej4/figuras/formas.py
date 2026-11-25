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