import pymysql
pymysql.install_as_MySQLdb()   # tiene que ir ANTES de importar flask_mysqldb

from flask import Flask, render_template, request
from flask_mysqldb import MySQL

app = Flask(__name__)
app.config['MYSQL_HOST'] = '127.0.0.1'
app.config['MYSQL_PORT'] = 41064          # puerto del contenedor XAMPP (número, sin comillas)
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'flaskcontacts'
mysql = MySQL(app)

@app.route('/')
def Index():
    return render_template('index.html')

@app.route('/add_contact', methods=['POST'])
def add_contact():
    if request.method == 'POST':
        fullname = request.form['fullname']
        phone = request.form['phone']
        email = request.form['email']
        cur = mysql.connection.cursor()
        cur.execute('INSERT INTO contacts(fullname, phone, email) VALUES(%s, %s, %s)',
                    (fullname, phone, email))
        mysql.connection.commit()
        return 'recibido'