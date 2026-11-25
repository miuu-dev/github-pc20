# creación de una clase
# si no especificamos que tipo de propiedad es (public, private, protected), significa que es público por defecto
class Coche():
    largo = 400
    ancho = 200
    ruedas = 4
    color = 'gris'
    enmarcha = False

    def arrancar(self, arrancamos):
        self.enmarcha = arrancamos
        if(self.enmarcha):
            return "El coche está en marcha"
        else:
            return "El coche está parado"

# instanciamos nuestro objeto llamado miCoche de la clase Coche
miCoche = Coche()

# juntamos dos métodos en uno indicamos que el parámetro booleano que metamos a la hora de llamar 'arrancar', haga que nos salga un resultado u otro
print(miCoche.arrancar(True))
print(miCoche.arrancar(False))

print(miCoche.ancho) # llamamos a nuestra variable con su instancia y pedimos que nos saque su ancho
print("El coche tiene ", miCoche.ruedas, " ruedas") # sacamos por pantalla el número de ruedas asignado
print(miCoche.estado()) # estamos pidiendo que nos saque por terminal el estado del coche instanciado, antes de ejecutar el método arrancar
miCoche.arrancar()
print(miCoche.estado()) # una vez ejecutemos el método arrancar, el estado del coche pasa a "True", indicando que está en marcha