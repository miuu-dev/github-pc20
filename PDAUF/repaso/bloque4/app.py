from flask import Flask, render_template
from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField
from wtforms.validators import DataRequired, Length

app = Flask(__name__)
app.config.from_mapping(
    SECRET_KEY = 'mi_clave'
)

class RegisterForm(FlaskForm):
    username  = StringField("Nombre de usuario: ", validators=[DataRequired(), Length(min= 4, max=25)])
    password = PasswordField("Contraseña: ", validators=[DataRequired(), Length(min=8, max=25)])
    submit = SubmitField("Registrar")
    
@app.route('/')
def index():
    return 'Pon auth/register para registrarte :D'

@app.route('/auth/register', methods=['GET', 'POST'])
def register():
    form = RegisterForm()
    if form.validate_on_submit():
        username = form.username.data
        password = form.password.data
        return f"Usuario registrado con éxito: {username}"
    
    return render_template('auth/register.html', form=form)

if __name__ == '__main__':
    app.run(debug=True)