class Persona():
    def __init__(self, nombre, edad, altura):
        self.nombre = nombre    # string
        self.edad = edad        # int
        self.altura = altura    # float

    # método saludar
    def saludar(self):
        print("Hola! Soy ", self.nombre)