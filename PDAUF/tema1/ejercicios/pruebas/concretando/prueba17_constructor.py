# creación de una clase
# si no especificamos que tipo de propiedad es (public, private, protected), significa que es público por defecto
class Coche():

    # constructor
    def __init__(self):
        self.largo = 400
        self.ancho = 200
        self.ruedas = 4
        self.color = 'gris'
        self.enmarcha = False

    def arrancar(self, arrancamos):
        self.enmarcha = arrancamos
        if(self.enmarcha):
            return "El coche está en marcha"
        else:
            return "El coche está parado"

    def estado(self):
        print("El coche tiene ", self.ruedas, " ruedas. Un ancho de ", self.ancho, " y un largo de ", self.largo)

miCoche = Coche()
miCoche2 = Coche()

# juntamos dos métodos en uno indicamos que el parámetro booleano que metamos a la hora de llamar 'arrancar', haga que nos salga un resultado u otro
# print(miCoche.arrancar(True))
# print(miCoche.arrancar(False))

print("--- creamos el segundo objeto ---")
miCoche2.ruedas = 3
print(miCoche2.arrancar(False))
miCoche2.estado()

