import sqlite3

conexion = None
cursor = None

# métodos externos
def crear_tabla():
    try:
        # nos conectamos a la bbdd
        conexion = sqlite3.connect('animales.db')
        cursor = conexion.cursor()
        
        sql_create = '''
            create table if not exists perros (
                id integer primary key autoincrement,
                raza varchar(50),
                color varchar(50),
                peso float,
                edad integer,
                sexo varchar(8),
                hijos integer
            )
        '''
        
        cursor.execute(sql_create)
        
        conexion.commit()
        
    except sqlite3.Error as err:
        print(f'Error: {err}')
    finally:
        if cursor:
            cursor.close()
        if conexion:
            conexion.close()

def actualizar(madre, padre):
    try:
        # nos conectamos a la bbdd
        conexion = sqlite3.connect('animales.db')
        cursor = conexion.cursor()
            
        n_hijos += 1
        
        sql_update = 'update perros set ? where raza = ? and color = ?'
            
        cursor.execute(sql_update, (n_hijos, madre, padre))
        
        conexion.commit()
            
    except sqlite3.Error as err:
        print(f'Error: {err}')
    finally:
        if cursor:
            cursor.close()
        if conexion:                
            conexion.close()

def insertar(new_dog):
    try:
        # nos conectamos a la bbdd
        conexion = sqlite3.connect('animales.db')
        cursor = conexion.cursor()
        
        valores = new_dog
            
        cursor.execute('insert into perros (NULL, ?, ?, ?, ?, ?, ?) values', (valores))
        
        conexion.commit()
            
    except sqlite3.Error as err:
        print(f'Error: {err}')
    finally:
        if cursor:
            cursor.close()
        if conexion:                
            conexion.close()

# valores a usar
PERROS_PRUEBA = [
    # (raza, color, peso, edad, sexo, hijos)
    # ---- HEMBRAS ----
    ('Labrado', 'dorado', 25.0, 4, 'hembra', 2),
    ('Beagle', 'tricolor', 12.0, 3, 'hembra', 1),   # hembra al cruzar
    ('Pastor Alemán', 'negro y fuego', 30.0, 5, 'hembra', 1), # mismos hijos que Beagle, más vieja
    ('Caniche', 'blanco', 6.0, 7, 'hembra', 3),
    ('Border Collie', 'blanco y negro', 18.0, 3, 'hembra', 1), # empata con beagle en hijos y edad
    
    # ---- MACHO ----
    ('Cocker', 'marrón', 13.0, 4, 'macho', '0'), # peso 13 , dif 1
    ('Beagle', 'marrón y blanco', 13.0, 6, 'macho', '3'), # peso 13 , dif 1 y MISMA raza
    ('Schnauzer', 'gris', 11.0, 5, 'macho', '1'), # peso 11, dif 1 por debajo
    ('Rotweiller', 'negro', 45.0, 6, 'macho', '2'),
    ('Dálmata', 'blanco y negro', 25.0, 2, 'macho', '0'),
]

def insertar_datos():
    try:
        conexion = sqlite3.connect('animales.db')
        cursor = conexion.cursor()
        
        # insertamos los datos
        cursor.executemany('insert into perros values (NULL, ?, ?, ?, ?, ?, ?)', PERROS_PRUEBA)
        
        # guardamos
        conexion.commit()
        
    except sqlite3.IntegrityError as err:
        print(f'Error: {err}')

# creamos la clase
class Perro:
    # constructor
    def __init__(self, raza, color, peso, edad, sexo, n_hijos):
        if sexo not in('macho', 'hembra'):
            print('El perro debe ser macho o hembra')
            
        if edad < 0:
            print('La edad no puede ser negativo')
            
        if peso <= 0:
            print('El peso no puede ser 0 o menor que 0')
        
        self.raza = raza
        self.color = color
        self.peso = peso
        self.edad = edad
        self.sexo = sexo
        self.n_hijos = n_hijos
        
        
    # métodos internos
    def cruzar(self, unPerro):
        # si son del mismo sexo, mensaje y returna None
        if self.sexo == unPerro.sexo:
            print('Ambos perros son del mismo sexo, no pueden procrear')
            return None
        else:
            # en caso de que sean sexos diferentes, estos procrean y tienen un hijo
            self.n_hijos += 1
        
        # si al que le asignamos el método es hembra, entonces es madre
        if self.sexo == 'hembra':
            madre = self
        else:
            madre = unPerro
            
        # si al que le asignamos el método NO es hembra, entonces es padre
        if self.sexo != 'hembra':
            padre = self
        else:
            padre = unPerro
        
        # actualizamos BBDD de la madre y padre
        actualizar(madre.raza, padre.color)
        
        # creamos el nuevo objeto guardándolo en una variable con sus respectivos datos
        cachorro = Perro(madre.raza, padre.color, 1, 0, 'hembra', 0)
        
        # lo insertamos dentro de la bbdd
        insertar(cachorro)
        
        # lo devolvemos
        return cachorro
    
    def obtenerTodos():
        todosPerros = []
        try:
            conexion = sqlite3.connect('animales.db')
            cursor = conexion.cursor()
            cursor.execute('select * from perros order by peso ASC')
            registros = cursor.fetchall()
            
            print('\n---- TODOS LOS PERROS (por peso) ----')
            for animal in registros:
                p = Perro(animal[1], animal[2], animal[3], animal[4], animal[5], animal[6])
                todosPerros.append(p)
                print(animal)
            print('------------------------------')
            
        except sqlite3.Error as err:
            print(f'Error: {err}')
        finally:
            if cursor:
                cursor.close()
            if conexion:                
                conexion.close()
        return todosPerros

    def obtenerParejaMasAfin(self, listaPerros):
        # mejor perro
        mejorPerro = None 
        
        # mejor perro con diferencia de peso
        mejorDiferencia = None
        
        # revisamos cada elemento dentro de la lista
        for perro in listaPerros:
            # si son del mismo sexo, se descarta
            if perro.sexo == self.sexo:
                continue
            
            # usamos abs() para calcular la diferencia de peso
            diferencia_peso = abs(perro.peso - self.peso)
            
            # si es el primer perro válido que encontramos, lo guardamos de forma provisional, y si tiene un peso parecido al self, lo guardamos también
            if mejorPerro is None or diferencia_peso < mejorDiferencia:
                mejorPerro = perro
                mejorDiferencia = diferencia_peso
                
            # si el criterio del peso es igual para varios perros, el más idóneo será aquel perro que sea de la misma raza que el perro desde el que se invoca
            elif (diferencia_peso == mejorDiferencia and perro.raza == self.raza and mejorPerro.raza != self.raza and mejorPerro.hijos < self.hijos):
                mejorPerro = perro
                
            else:
                return None
            
        return mejorPerro
            
    def obtenerHembra(listaPerros):
        hembra_ideal = None
        for perro in listaPerros:
            if perro.sexo != 'hembra':
                continue
            
            if hembra_ideal is None:
                hembra_ideal = perro
            elif perro.n_hijos < hembra_ideal.n_hijos:
                hembra_ideal = perro
            elif perro.n_hijos == hembra_ideal.n_hijos and perro.edad < hembra_ideal.edad:
                hembra_ideal = perro
                
        return hembra_ideal

    def crearInformeTxt(apellido):
        conexion = sqlite3.connect('animales.db')
        cursor = conexion.cursor()
        cursor.execute('select * from perros')
        registros = cursor.fetchall()
        
        nombre_fichero = f'{apellido}.txt'
        
        informe = open(f'{nombre_fichero}', 'w', encoding='utf-8')
        informe.write('-------- PERROS --------\n')
        for dato in registros:
            id = dato[0]
            raza = dato[1]
            color = dato[2]
            peso = float(dato[3])
            edad = int(dato[4])
            sexo = dato[5]
            hijos = int(dato[6])
            
            informe.write(f'{id};{raza};{color};{peso};{edad};{sexo};{hijos}\n')    
            
        print(f'\nFichero {nombre_fichero} creado correctamente!')


# usar métodos necesarios
# crear_tabla()
# insertar_datos() -> datos ya insertados