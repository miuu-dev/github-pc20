# 3. envolvemos la apertura en un bloque para evitar errores
try: 
    # 1. abrimos el fichero misiones.txt, le damos los permisos de crear un fichero y le ponemos el encoding
    ficheroMisiones = open('./misiones.txt', 'x', encoding='utf-8')

    # 2. escribimos dentro del fichero la primera linea
    ficheroMisiones.write('Misión 1: Rescatar al herrero de Robleverde\n')

    ficheroMisiones.close()

except FileExistsError as e:
    print('El registro de misiones ya existe. No se puede crear de nuevo')
    print(f'Error: {e}')


# 4. agregar un bloque final o segundo paso que abra el fichero en modo inserción 'a'
try: 
    ficheroMisiones = open('./misiones.txt', 'a', encoding='utf-8')

    mision2 = 'Misión 2: Explorar las ruinas ancestrales\n'

    ficheroMisiones.write(mision2)

    ficheroMisiones.close()

except OSError as e:
    print('No se pudo añadir información')
    print(f'Error: {e}')