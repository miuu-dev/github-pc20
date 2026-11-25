from abc import ABC, abstractmethod # si queremos algo abstracto, hemos de poner siempre esta línea como la PRIMERA del fichero

# CLASE PADRE
# Ponemos que cada método es abstracto para no usarlo directamente porque todos los personajes que tendremos serán una clase u otra.
# Es por ello que luego crearemos las clases hijas (tipo de personaje (mago, guerrero, etc.)) y todos van a tener los siguientes métodos que SÍ serán implantados DENTRO de las clases hijas
class Personaje(ABC):
    @abstractmethod
    def __init__(self, nombre):
        self.nombre = nombre
        self.nivel = 0
        self.inventario = [] # es un array porque en el inventario puedes llevar varios objetos
        self.vida = 100

    @abstractmethod
    def atacar(self, objetivo):
        pass

    @abstractmethod
    def estado(self):
        print("El personaje ", self.nombre, " tiene un nivel de ", self.nivel)

    @abstractmethod
    def subirNivel(self):
        self.nivel += 1

    @abstractmethod
    def verInventario(self):
        print(f"Inventario de {self.nombre}")
        for objeto in self.inventario:
            print(objeto)

# No todos los personajes tienen la misma vida, o el mismo inventario, es por ello que usaremos super() para poder añadir la información perteneciente de cada uno, en este caso, antes de que muestre por pantalla el estado de cada personaje, queremos que aparezca primero su tipo de clase
# Y en el constructor de cada clase hija indicamos que el nombre que le demos a la clase principal, será añadido en el apartado "nombre" del constructor padre. Se SOBREESCRIBE
# CLASE HIJA - Mago
class Mago(Personaje):
    def __init__(self, nombre):
        super().__init__(nombre)
        self.vida = 120
        self.inteligencia = 100
        self.inventario = ["Poción mágina", "Libro conjutos"]

    def estado(self):
        print(f"Clase Mago")
        super().estado()

    def atacar(self, objetivo):
        objetivo.vida -= self.inteligencia * 0.6
        print(f"La vida actual del objetivo es {objetivo.vida}")

    def subirNivel(self):
        self.nivel += 1

    def verInventario(self):
        print(f"Inventario de {self.nombre}")
        for objeto in self.inventario:
            print(objeto)

# CLASE HIJA - Guerrero
class Guerrero(Personaje):
    def __init__(self, nombre):
        super().__init__(nombre)
        self.vida = 120
        self.fuerza = 75
        self.inventario = ["Poción de vida", "Escudo", "Espada"]

    def estado(self):
        print(f"Clase Guerrero")
        super().estado()

    def atacar(self, objetivo):
        objetivo.vida -= self.fuerza * 0.5
        print(f"La vida actual del objetivo es {objetivo.vida}")

    def subirNivel(self):
        self.nivel += 1

    def verInventario(self):
        print(f"Inventario de {self.nombre}")
        for objeto in self.inventario:
            print(objeto)


# MÉTODO PRINCIPAL
# Un error que podemos cometer es el siguiente
# p1 = Personaje("Merlín") -> las clases ABSTRACTAS NO SE PUEDEN INSTANCIAR

# Forma correcta para instanciar objetos (desde las clases hijas)
guerrero1 = Guerrero("He-Man")
mago1 = Mago("Merlín")

guerrero1.estado()
print("")
mago1.estado()
print("")

guerrero1.verInventario()
print("")
mago1.verInventario()
print("")

guerrero1.atacar(mago1)
print("")
mago1.atacar(guerrero1)
