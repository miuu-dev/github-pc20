class CuentaBancaria:
    # atributos privados
    def __init__(self, numero, saldo_inicial):
        self.__numero = numero
        self.__saldo_inicial = saldo_inicial

    # método público 1
    def ingresar(self, cantidad):
        if cantidad > 0:
            self.__saldo_inicial += cantidad

    # método público 2
    def obtener_saldo(self):
        return self.__saldo_inicial


# programa principal
cuenta = CuentaBancaria(1234, 10000)
cuenta.ingresar(500)
print(f'Saldo de la cuenta: {cuenta.obtener_saldo()}')

# print(cuenta.__saldo_inicial) # no se puede acceder a un atributo encapsulado desde el programa principal