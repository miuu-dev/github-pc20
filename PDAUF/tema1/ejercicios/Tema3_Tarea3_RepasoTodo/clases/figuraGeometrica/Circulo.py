import math
from .FiguraGeometrica import FiguraGeometrica

class Circulo(FiguraGeometrica):
    def __init__(self, radio):
        self.radio = radio 

    def calcular_area(self):
        area = math.pi * (self.radio ** 2)
        return area