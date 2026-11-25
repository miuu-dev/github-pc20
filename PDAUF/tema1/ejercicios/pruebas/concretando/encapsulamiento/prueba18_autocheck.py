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

    # no tiene sentido, pero es para comprobar que funciona, pero se hace antes del método arrancar
    def auto_check(self):
        print("Vamos a realizar un chequeo")
        self.gasolina = "ok"
        self.aceite = "ok"
        self.puertas = "cerradas"

        if(self.gasolina == "ok" and self.aceite == "ok" and self.puertas == "cerradas"):
            return True
        else:
            return False

    def arrancar(self, arrancamos):
        self._enmarcha = arrancamos
        if(self.__enmarcha):
            check = self.autocheck()

        if(self.__enmarcha and check):
            return "El coche está en marcha"

        elif(self.__enmarcha and check == False):
            return "Chequeo no superado. Arranque no posible"

        else:
            return "El coche está parado"

    def estado(self):
        print("El coche tiene ", self.ruedas, " ruedas. Un ancho de ", self.ancho, " y un largo de ", self.largo)




