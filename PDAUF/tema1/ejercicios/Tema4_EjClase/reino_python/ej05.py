mochila = ['Antorcha', 'Cuerda de 10 metros', 'Poción de vida', 'Mapa del reino']

fichero = open('mochila.txt', 'w', encoding='utf-8')
fichero.writelines(map(lambda objeto: objeto + '\n', mochila))
# creamos un array map donde le diremos que coja un elemento y lo saque por pantalla con un salto de línea, y que sea de la lista mochila

fichero.close()
