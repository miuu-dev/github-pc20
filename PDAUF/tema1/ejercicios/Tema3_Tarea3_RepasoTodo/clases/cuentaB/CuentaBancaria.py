class CuentaBancaria():
    def __init__(self, numero, saldo):
        self.__numero = numero
        self.__saldo = saldo 

    # métodos públicos
    def getNumero(self):
        return self.__numero 

    def getSaldo(self):
        return self.__saldo

    def cb_info(self):
        print(
            "Número: ", self.getNumero(), 
            "\nSaldo: \t", self.getSaldo()
        )