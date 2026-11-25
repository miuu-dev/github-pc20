# EJERCICIO 7: Módulos
from clases.persona.Persona import Persona
from clases.persona.Empleado import Empleado

from clases.figura.Circulo import Circulo
from clases.figura.Rectangulo import Rectangulo

from clases.cuentaB.CuentaBancaria import CuentaBancaria

from clases.figuraGeometrica.Circulo import Circulo
from clases.figuraGeometrica.Rectangulo import Rectangulo

from clases.figuraPaquete.Figuras import Circulo3, Rectangulo3




# EJERCICIO 1: Crear una clase
print("---- 1. CREAR UNA CLASE ----")
persona1 = Persona("Juán Pérez", 25, 1.70)
print(
    "Nombre:\t", persona1.nombre,
    "\nEdad:\t", persona1.edad, " años",
    "\nAltura:\t", persona1.altura, "m"
)


# EJERCICIO 2: Crear un método
print("\n---- 2. CREAR UN MÉTODO ----")
persona1.saludar()


# EJERCICIO 3: Herencia
print("\n---- 3. HERENCIA ----")
persona2 = Empleado("María García", 30, 1.65, 2000)

print(
    "Nombre:\t", persona2.nombre,
    "\nEdad:\t", persona2.edad, " años",
    "\nAltura:\t", persona2.altura, "m",
    "\nSalario:", persona2.salario, "€"
)


# EJERCICIO 4: Polimorfismo
print("\n---- 4. POLIMORFISMO ----")
circulo1 = Circulo(4)
print(f"El área del círculo1 es \t {circulo1.calcular_area():.2f}")

rectangulo1 = Rectangulo(2, 4)
print("El área del rectángulo1 es \t", rectangulo1.calcular_area())



# EJERCICIO 5: Encapsulamiento
print("\n---- 5. ENCAPSULAMIENTO ----")
cuentaBancaria1 = CuentaBancaria("1234-5678-9012-3456", 1000)
cuentaBancaria1.cb_info()


# EJERCICIO 6: Clases abstractas
print("\n---- 6. CLASES ABSTRACTAS ----")
circulo2 = Circulo(8)
print(f"El área del círculo2 es \t {circulo2.calcular_area():.2f}")

rectangulo2 = Rectangulo(5, 8)
print("El área del rectángulo2 es \t", rectangulo2.calcular_area())


# EJERCICIO 8: Paquetes
print("\n---- 8. PAQUETES ----")
circulo3 = Circulo3(4)
print(f"El área del círculo3 es \t {circulo3.calcular_area():.2f}")

rectangulo3 = Rectangulo3(3, 7)
print("El área del rectángulo3 es \t", rectangulo3.calcular_area())
