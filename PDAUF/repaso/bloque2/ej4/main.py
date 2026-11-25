from src.repaso.bloque2.ej4.figuras.formas import Circulo, Rectangulo

# programa principal
# figura = FiguraGeometrica() → da error porque no se puede crear un objeto de un método abstracto
c = Circulo(2.5)
r = Rectangulo(2, 7.72)

print(f'{c.calcular_area():.2f}')
print(f'{r.calcular_area():.2f}')