import sqlite3

fichero = open('bestiario.txt', 'a', encoding='utf-8')

nuevasCriaturas = [
    "\nBasilisco;Monstruo;90;55\n",
    "Esqueleto;No muerto;20;6\n",
    "Espectro;No muerto;40;18\n",
]

fichero.writelines(nuevasCriaturas)
fichero.close()


# conexión
miConexion = sqlite3.connect("Bestiario")
miCursor = miConexion.cursor()

insertados = 0
rechazados = 0

fichero = open('bestiario.txt', 'rt', encoding='utf-8')
lineas = fichero.readlines()
for linea in lineas:
    lineaLimpia = linea.strip() 
    if not lineaLimpia:
        continue

    nombre, tipo, vida, recompensa = lineaLimpia.split(";")

    try:
        # insertamos
        miCursor.execute("insert into bestiario (nombre, tipo, vida, recompensa) values (?,?,?,?)", (nombre, tipo, int(vida), int(recompensa)))
        miConexion.commit()
        insertados += 1
        
    except sqlite3.IntegrityError:
        rechazados += 1
        rechazo = open('f_error.txt', 'a', encoding='utf-8')
        rechazo.write(f"Duplicados: {nombre}\n")
        rechazo.close()

miCursor.close()
miConexion.close()

print("Proceso finalizado: ")
print(f"- Criaturas insertadas: {insertados}")
print(f"- Critauras rechazadas: {rechazados}")