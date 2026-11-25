'''# BUCLE FOR
for i in range (0,100):
    print('Soy la vuelta', i)

print()
'''

# BUCLE FOR ejemplo repetido
print('Comienzo')
for i in [0,1,2]:
    print('Hola ', end='')
print()
print('Final')

print()

# BUCLE FOR ejemplo (f - formato) para que nos de una linea con
# texto y el valo multiplicado por 2
print('Comienzo')
for i in [3,4,5]:
    print(f'Hola. Ahora i vale {i} y su cuadrado {i ** 2}')
print('Final')

print()

#BUCLE FOR ejemplo donde decimos que i es lo que tenemos puesto
# en la lista añadida en el BUCLE FOR
print('Comienzo')
for i in ['Alba', 'Benito', 27]:
    print(f'Hola. Ahora i vale {i}')
print('Final')