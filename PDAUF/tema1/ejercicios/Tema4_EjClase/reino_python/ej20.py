import sqlite3

miConexion = sqlite3.connect("Bestiario")
miCursor = miConexion.cursor()

# 1. CONSULTA
miCursor.execute("select nombre, tipo, vida, recompensa from bestiario")
filas = miCursor.fetchall()

# variables
totalCriaturas = len(filas)
totalOro = 0
lineasInforme = ["INFORME DEL BESTIARIO \n\n"]

# 2. Recorrer resultados
for i,r in enumerate(filas, start=1):
    nombre, tipo, vida, oro = r
    totalOro += oro

    lineasInforme.append(f"{i}. {nombre} {tipo}\n")
    lineasInforme.append(f"    Vida: {vida}\n")
    lineasInforme.append(f"    Oro: {oro}\n")


# Aádir al resumen final
lineasInforme.append(f"\nTotal de criaturas: {totalCriaturas}")
lineasInforme.append(f"\nTotal de oro en recompensas: {totalOro}")

fichero = open('informe_bestiario.txt', 'w', encoding='utf-8')
fichero.writelines(lineasInforme)

miCursor.close()
miConexion.close()