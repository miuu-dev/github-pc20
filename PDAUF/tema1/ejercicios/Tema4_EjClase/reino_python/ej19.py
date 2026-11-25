import sqlite3

# CONEXIÓN A LA BASE DE DATOS
miConextion = sqlite3.connect("Bestiario")
miCursor = miConextion.cursor()

def mostrarTabla(miCursor):
    miCursor.execute("select * from bestiario")
    registros = miCursor.fetchall()
    print("\n--- 1. ESTADO ACTUAL DE LA TABLA ---")
    for registro in registros:
        print(f"ID: {registro[0]} | Nombre: {registro[1]} | Tipo: {registro[2]} | Vida: {registro[3]} | Recompensa: {registro[4]}")

    print("-" * 43)


# ==========================================
# 1. CREATE: Insertar una nueva criatura con input()
# ==========================================
# 1. Crear criatura
print("--- 1. Create (Añadir criaturas ---)")
nombre = input("Nombre: ")
tipo = input("Tipo: ")
vida = input("Vida: ")
recompensa = input("Recompensa: ")

# 2. Insertar en la bbdd
miCursor.execute("insert into bestiario (nombre, tipo, vida, recompensa) VALUES (?,?,?,?)", (nombre, tipo, vida, recompensa))

miConextion.commit()
print(f"Criatura '{nombre}' introducida correctamente")

mostrarTabla(miCursor)


# ==========================================
# 2. READ: Consultas
# ==========================================
print("\n--- 2. READ (consultar criaturas) ---")
print("a) todos los monstruos: ")
miCursor.execute("select * from bestiario")
bestias = miCursor.fetchall()
for bestia in bestias:
    print(f"   - {bestia[1]} -> Vida: {bestia[3]}")


# ==========================================
# 3. UPDATE: Actualizar Troll de las cavernas
# ==========================================
print("\n--- 3. UPDATE (Modificar Troll) ---")
miCursor.execute('''
    update bestiario set vida = 95, recompensa = 45 where nombre = "Troll de las cavernas"
''')

miConextion.commit()
print("-> Vida del Troll actualizada a 95 y recompensa a 45.")
mostrarTabla(miCursor)


# ==========================================
# 4. DELETE: Borrar al Goblin usando su ID
# ==========================================
print("\n--- 4. DELETE (Eliminar Goblin por su ID) ---")
miCursor.execute("select id from bestiario where nombre = 'Goblin'")
resultado = miCursor.fetchone()

if resultado:
    idGoblin = resultado[0]
    miCursor.execute("delete from bestiario where id = ?", (idGoblin,))
    miConextion.commit()
    print(f"> Goblin eliminado (ID: {idGoblin})")
else:
    print("> No se encontró ningún Goblin")

mostrarTabla(miCursor)

miConextion.close()