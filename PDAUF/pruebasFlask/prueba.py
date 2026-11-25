from flask import Flask
from markupsafe import escape

app = Flask(__name__)

@app.route('/')
def hello():
    return "Hola Mundo"



@app.route('/hello')
@app.route('/hello/<name>')
@app.route('/hello/<name>/<int:age>')
def hello_person(name=None, age=None):
    if name is None and age is None:
        return '<h1>Hola</h1>'
    elif age is None:
        return f'<h1>Hola {name}</h1>'
    else:
        return f'<h1>Hola {name}, el doble de tu edad es {age * 2} años</h1>'



# COMO CÓDIGO EJECUTABLE
@app.route('/code/<path:code>')
def code(code):
    return f'<code>{code}</code>'



# COMO TEXTO
@app.route('/route/<path:code>')
def code2(code):
    return f'<code>{escape(code)}</code>'
