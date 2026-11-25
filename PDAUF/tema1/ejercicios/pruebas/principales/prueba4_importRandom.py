'''import random

print("Comienzo")
sacaste_cinco = False

for i in range(3):
    dado = random.randrange(1,7)
    print(f"Tirada {i+1}: {dado}")
    if dado == 5:
        sacaste_cinco = True

if sacaste_cinco:
    print("Ha salido al menos un 5")
else:
    print("No ha salido ningún 5")

print("Final")
'''

# Funciones sin parámetros
def mi_info():
    print("Estás en un curso de Python")
    print("En este tema estás estudiando las funciones")

print("Vamos a probar las funciones")
mi_info()
print("Final")