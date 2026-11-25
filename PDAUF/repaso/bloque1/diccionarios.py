# CONSULTA Y ACCESO
# get
usuario = {
    'Nombre': 'Miruna',
    'Edad': 19
}
print(f'El nombre del usuario es : {usuario.get('Nombre')}')
print(f'El email del usuario es: {usuario.get('Email', 'N/A')} \n') # si no existe, hacemos que saque el 2do dato

# keys y values
coche = {
    'marca': 'Renault',
    'modelo': '7',
    'year': 1975
}
print(f'Las clave (keys) de coche es: {coche.keys()}')
print(f'Los valores (values) de coche es: {coche.values()} \n')

# items
print(f'{coche.items()}')
for clave, valor in coche.items():
    print(f'La clave es {clave}, y su valor es {valor}')
print()

# setdefault
stock = {
    'manzanas': 5
}
cantidadPeras = stock.setdefault('peras', 5) # en caso de que en stock no exista la clave valor, ese se crea y lo añade. con setdefault sacamos su valor en la clave decidida
cantidadManzanas = stock.setdefault('manzanas')
cantidadNaranjas = stock.setdefault('naranjas') # al no existir y no darle un valor, se le pondrá None
print(f'Cantidad peras: {cantidadPeras}')
print(f'Cantidad manzanas: {cantidadManzanas}')
print(f'Cantidad naranjas: {cantidadNaranjas}')
print(f'{stock} \n')


# MODIFICACIÓN E INSERCIÓN
# update({...})
perfil = {
    'nombre': 'Aria'
}
print(f'El perfil es: {perfil}')
perfil.update({
    'clase': 'Exploradora',
    'nivel': 3
})
print(f'El perfil es: {perfil} \n')

# fromkeys → crea un nuevo diccionario a partir de una secuencia de claves
claves = ['id', 'nombre', 'rol']
new_dicc = dict.fromkeys(claves, None) # a los valores les asignamos None
print(f'{new_dicc} \n')


# ELIMINACIÓN
# pop
print(f'Coche: {coche}')
eliminado = coche.pop('marca') # eliminamos marca y devuelve renault
print(f'Coche: {coche}')
print(f'Eliminado: {eliminado} \n')

# popitem
datos = {
    'a': 1,
    'b': 2,
    'c': 3
}
print(f'Datos: {datos}')
ultimo = datos.popitem()
print(f'Dato eliminado: {ultimo} \n')

# clear
agenda = {
    'Juan': '12341234'
}
print(f'Agenda: {agenda}')
agenda.clear()
print(f'Agenda: {agenda} \n')


# COPIA
# copy
original = {
    'a': 1
}
copia = original.copy()
copia['b'] = 2 # añadimos este dato a COPIA, al final
print(f'Original: {original}')
print(f'Copia: {copia}')