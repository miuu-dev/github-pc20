from .Figura import Figura

class Rectangulo(Figura):
    def __init__(self, ancho, largo):
        self.ancho = ancho
        self.largo = largo

    def calcular_area(self):
        area = self.ancho * self.largo 
        return area
