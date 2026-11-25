fichero = open('misiones.txt', 'x', encoding='utf-8')

fichero.write('Misión 1: Rescatar al herrero')
print(fichero.writable()) # true
print(fichero.readable()) # false

fichero.close()