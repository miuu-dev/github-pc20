from datetime import datetime
from flask import Flask, render_template

app = Flask(__name__)


# Filtro personalizado
@app.template_filter('hoy')
def hoy(date):
    if isinstance(date, datetime):
        return date.strftime('%d-%m-%Y')
    return date


# Función global registrada como decorador
@app.template_global('repite')
def repite(texto, veces):
    return texto * veces


@app.route('/hello')
@app.route('/hello/<name>')
@app.route('/hello/<name>/<int:age>')
@app.route('/hello/<name>/<int:age>/<email>')
def hello(name=None, age=None, email=None):
    data = {'name': name, 'age': age, 'email': email}
    # Le pasamos date para que {{ date | hoy }} no falle en la plantilla
    return render_template('index.html', data=data, date=datetime.now())


@app.route('/')
@app.route('/index')
def index():
    name = 'Miuu'
    friends = ['Susana', 'Laura', 'Marta']
    content = '<3'
    date = datetime.now()

    data = {'name': name, 'age': 19, 'email': 'mimatei07@gmail.com'}

    return render_template(
        'index.html',
        name=name,
        content=content,
        friends=friends,
        date=date,
        data=data,
    )