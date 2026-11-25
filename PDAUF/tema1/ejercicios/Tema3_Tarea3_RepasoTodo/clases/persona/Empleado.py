from .Persona import Persona

class Empleado(Persona):
    def __init__(self, nombre, edad, altura, salario):
            super().__init__(nombre, edad, altura)
            self.salario = salario 

    def saludar(self):
        return super().saludar()