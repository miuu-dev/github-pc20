# CREACIÓN DE VARIABLES + SALIDA DEL TECLADO
print('¿Cómo te llamas?')
nombre = input() #nombre usuario

print('¿En qué año naciste?')
year = int(input())  #int convierte en entero la 
# entrada de teclado que de otro modo sería un string

edad = 2026 - year #edad usuario (en el 2026)
print('Hola', nombre, 'tienes', edad, 'años')



# CONDICIONALES
if edad > 18:
    print ('Hola', nombre, 'eres muy viejo/a')
elif edad == 16:
    print('Eres casi mayor de edad')
else:
    print('Hola', nombre, 'eres muy joven')