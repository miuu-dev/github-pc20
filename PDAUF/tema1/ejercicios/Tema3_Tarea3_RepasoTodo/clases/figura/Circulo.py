import math
from .Figura import Figura

class Circulo(Figura):
    def __init__(self, radio):
        self.radio = radio

    def calcular_area(self):
        area = math.pi * (self.radio ** 2)
        return area