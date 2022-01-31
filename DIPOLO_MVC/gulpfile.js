/*Este archivo le dice a gulp que aqui va a encontrar toda la configuracion que requiere.*/
/*Gulp va a entender este archivo. Gulp va a buscar a este archivo el cual tiene el codigo
para ejecutar las tareas.*/

/*Siempre que se vaya a crear un proyecto con gulp, se requiere de los archivos gulpfile.js y package.json.*/

/*El archivo package.json es importante porque ahí se va a instalar lo que node.js conoce como las dependencias */


//Importa ciertas funciones de la carpeta gulp que está en la carpeta node_modules
const {series, src, dest, watch }= require('gulp');
/*La función src indica donde encontrar los archivos sass */


const sass= require('gulp-sass') (require('sass'));
//var sass = require('gulp-sass')(require('sass'));

const concat = require('gulp-concat');


//Función que compila SASS

function css( ){ //done es la funcion que se manda a llamar cuando finaliza la ejecucion del codigo
    return src('src/scss/app.scss')
        .pipe( sass())//colocar como argumento de sass {outputStyle: 'compressed'}
        .pipe( dest('./public/build/css') );
}


function minificarcss( ){ //done es la funcion que se manda a llamar cuando finaliza la ejecucion del codigo
    return src('src/scss/app.scss')
        .pipe( sass({outputStyle: 'compressed'}))
        .pipe( dest('./public/build/css') );
}

function javascript() {
    return src('src/js/**/*.js')
        .pipe( concat('bundle.js'))
        .pipe( dest('./public/build/js'));
}


// function hola(done){
//     console.log('holaaaaaaaaaa');
//     done();
// }

function watchArchivos() {
    watch('src/scss/**/*.scss', css);/*Aplica watchArchivos a: todos los archivos de las 
    carpetas contendidas en scss con extension .scss */
    watch('src/js/**/*.js', javascript);/*Aplica watchArchivos a: todos los archivos de las 
    carpetas contendidas en js con extension .js */
}
/* Observaciones:
                *->todos los archivos
                **-> todas las carpetas
*/



//Sirve para hacer disponible el código de forma externa
//Primero va el comando con el que se llamará la función que se especifica a la derecha
//La función series que se importó sirve para ejecutar varias funciones con un solo comando de manera secuencial
exports.css= css;
exports.minificarcss = minificarcss;
exports.watchArchivos = watchArchivos;

exports.default = series(css, javascript, watchArchivos);