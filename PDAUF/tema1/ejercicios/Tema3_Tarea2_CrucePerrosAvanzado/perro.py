class Perro():
    # constructor
    def __init__(self, raza, color, peso, edad, sexo):
        if sexo not in ('macho', 'hembra'):
            raise ValueError('El sexo debe ser "macho" o "hembra"')
        self.raza = raza
        self.color = color
        self.peso = peso
        self.edad = edad
        self.sexo = sexo

    # método normal cruzarPerros(self, otroPerro)
    def cruzarPerros(self, otroPerro):
            if self.sexo == otroPerro.sexo:
                print("Ambos perros son del mismo sexo, no pueden procrear")
                # NO OLVIDAR: poner siempre un return
                return None
    
            if self.sexo == 'hembra':
                madre = self
            else:
                madre = otroPerro
    
            return Perro(madre.raza, madre.color, 1, 0, 'hembra')


    # ---- AMPLIACIÓN ----
    # método estático cruzar (perro1, perro2)
    @staticmethod
    def cruzar(perro1, perro2):
        if perro1.sexo == perro2.sexo:
            print("Ambos perros son del mismo sexo, no pueden procrear")
            # NO OLVIDAR: poner siempre un return
            return None

        if perro1.sexo == 'hembra':
            madre = perro1
        else:
            madre = perro2

        return Perro(madre.raza, madre.color, 1, 0, 'hembra')

    # método estático obtenerHembras(l1, l2)
    @staticmethod
    def obtenerHembras(l1, l2):
        # guardamos los datos
        hembras = []

        # creamos un bucle for-in donde queremos que funcione tanto en la lista 1 como en la lista 2 dándole que cada dato es un perro
        for perro in l1 + l2:
            # si el dato dado tiene de sexo 'hembra', este se añadirá en el array 'hembras'
            if perro.sexo == 'hembra':
                hembras.append(perro)

        # una vez compruebe si es hembra o no, se devolverá el array con los datos añadidos
        return hembras

    # método normal obtenerParejaMasAfin(l1)
    def obtenerParejaMasAfin(self, l1):
        # preparamos las variables vacías para ir guardando cual es el mejor perro conforme continuemos con el código
        mejor = None
        mejorDiferencia = None

        # revisamos cada elemento dentro de la lista 
        for perro in l1:
            # si son del mismo sexo, se descartaría
            if perro.sexo == self.sexo:
                continue

            # usamos abs() para poder calcular el peso entre el perro candidato y el peso del perro que hace referencia self
            diferenciaPeso = abs(perro.peso - self.peso)

            # si es el primer perro válido que encontramos, lo guardamos como el mejor candidatos de forma provisional, o si tiene un peso más parecido al self, lo guardamos también
            if mejor is None or diferenciaPeso < mejorDiferencia:
                mejor = perro
                mejorDiferencia = diferenciaPeso

            # en caso de que diferencia de peso es igual a la mejor diferencia de pesos, y la raza del perro es la misma que el perro self y la raza NO es la misma que la de nuestro perro, ponemos que ESE es el mejor perro
            elif (diferenciaPeso == mejorDiferencia 
                    and perro.raza == self.raza 
                    and mejor.raza != self.raza):
                mejor = perro

        return mejor