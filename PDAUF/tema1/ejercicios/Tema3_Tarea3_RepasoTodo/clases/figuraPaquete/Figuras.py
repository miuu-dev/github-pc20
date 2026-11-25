import math

class Figuras:
    def calcular_area(self):
        pass


class Circulo3(Figuras):
    def __init__(self, radio):
        self.radio = radio 

    def calcular_area(self):
        return math.pi * (self.radio ** 2)


class Rectangulo3(Figuras):
    def __init__(self, ancho, largo):
        self.ancho = ancho 
        self.largo = largo 

    def calcular_area(self):
        return self.ancho * self.largo 