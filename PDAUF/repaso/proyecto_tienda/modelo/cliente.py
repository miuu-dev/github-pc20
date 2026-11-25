class Persona:
    def __init__(self, nombre, email, edad):
        self.nombre = nombre
        self.email = email
        self.__edad = edad
        
    def obtener_edad(self):
        return self.__edad
    
    def mostrar_info(self):
        return f'Nombre: {self.nombre} | Email: {self.email} | Edad: {self.__edad}'
    
    
class ClienteVIP(Persona):
    def __init__(self, nombre, email, edad, saldo= 0.0):
        super().__init__(nombre, email, edad)
        self.saldo = float(saldo)
        
    def mostrar_info(self):
        base = super().mostrar_info()
        return f'{base} | Saldo VIP: {self.saldo:.2f}€'