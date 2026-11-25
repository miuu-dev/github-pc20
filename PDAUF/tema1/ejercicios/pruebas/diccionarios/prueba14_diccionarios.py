# x es la palabra CLAVE, y cuando decimos mi_coche[x], estamos indicando que queremos que nos saque el VALOR

mi_coche = {
    'Marca': 'Renault',
    'Modelo': '7',
    'Año': 1945
}

print("1. Ver la lista normal")
for x in mi_coche:
    print(x, ": ", mi_coche[x])

print("")
print("2. Modificar el modelo")
# para modificar el modelo del diccionario
mi_coche['Modelo'] = '8'

for x in mi_coche:
    print(x, ": ", mi_coche[x])

