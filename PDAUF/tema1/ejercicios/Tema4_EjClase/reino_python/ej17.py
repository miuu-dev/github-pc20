fichero = open('bestiario.txt', 'rt', encoding='utf-8')

lineas = fichero.readlines()

for linea in lineas:
    elementos = linea.strip().split(';')
    print('Goblin (',elementos[1],') - Vida: ',elementos[2],' - Recompensa: ',elementos[3])