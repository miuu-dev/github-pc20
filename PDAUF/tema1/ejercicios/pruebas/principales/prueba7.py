'''
id(a) devuelve un número entero que sirve como un 
identificador único para el objeto durante su tiempo 
de vida. Es la dirección de memoria donde se almacena 
el objeto.
'''


def aumenta(x):
    print(id(x))
    x+=1
    print(id(x))
    return x

a=5
b=3
print(id(3),id(4))
print(id(a))
print(aumenta(b))
print(b)
print(id(b))


'''
cada vez que se ejecute este programa, en distintos 
dispositivos, el resultado será diferente.

es por ello que en el word del profesor contiene un
resultado diferente al mío, en el dispositivo de clase
'''