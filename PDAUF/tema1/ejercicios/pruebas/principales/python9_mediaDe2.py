def calcular_media(x,y):
    resultado = (x+y) / 2
    return resultado


notas = [9,8,7,8,9,7]

for i in range(0, len(notas)-1, 2):
    a = notas[i]
    b = notas[i +1]
    media = calcular_media(a,b)
    print(f"La media entre {a} y {b} es: {media}")


print(f"Programa terminado")