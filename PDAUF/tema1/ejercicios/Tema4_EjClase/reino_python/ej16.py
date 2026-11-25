fichero = open('bestiario.txt', 'w', encoding='utf-8')

criaturas = [
    "Goblin;Humanoide;15;5\n",
    "Lobo huargo;Bestia;25;8\n",
    "Esqueleto;No muerto;20;6\n",
    "Troll de las cavernas;Gigante;80;40\n",
    "Arpía;Monstruo;30;12\n",
    "Dragón joven;Dragón;150;100\n",
]

fichero.writelines(criaturas)