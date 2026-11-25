import sqlite3

conexion = None
cursor = None

# función subir nivel
def subir_nivel(name, new_level):
    query_update = 'update heroes set nivel = ? where nombre = ?'
    cursor.execute(query_update, (new_level, name))
    conexion.commit()
    print(f"Nivel de '{name}' actualizado a {new_level}.")

# función borrar
def retirar_heroe(id_heroe):
    query_delete = 'delete from heroes where id = ?'
    cursor.execute(query_delete, (id_heroe,))  # la coma final es obligatoria en tuplas de 1 elemento
    conexion.commit()
    print(f"Héroe con ID {id_heroe} retirado del gremio.")

try:
    conexion = sqlite3.connect('Gremio.db')
    cursor = conexion.cursor()

    # sql_create = '''
    #     create table if not exists heroes (
    #         id integer primary key autoincrement,
    #         nombre varchar(50) unique,
    #         clase varchar(20),
    #         nivel integer
    #     )
    # '''
    # cursor.execute(sql_create)
    
    # sql_insert = 'insert into heroes (id, nombre, clase, nivel) values (NULL, ?, ?, ?)'

    # heroes = [
    #     ("Merlín", "Mago", 1),
    #     ("He-Man", "Guerrero", 1),
    #     ("Morgana", "Mago", 2),
    #     ("Arthur", "Guerrero", 2)
    # ]
    
    # cursor.executemany(sql_insert, heroes)
    # conexion.commit()
    
    # print(f'{cursor.rowcount} héroes insertador correctamente') → se comenta después de haberlo ejecutado SIN usar los métodos
    
    subir_nivel("Merlín", 3)
    retirar_heroe(2)

except (sqlite3.IntegrityError, sqlite3.Error) as e:
    print(f'Error general: {e}')

finally:
    if cursor:
        cursor.close()

    if conexion:
        conexion.close()