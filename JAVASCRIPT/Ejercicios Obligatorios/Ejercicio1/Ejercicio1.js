//Apartado a)
let nombre = ("Carlos");

//Apartado b)
let edad = 19;

//Apartado c)
let esEstudiante = true;

//Apartado d)
const PI = 3.14159;

//Apartado e)
let colores = ["rojo", "verde", "azul"];
const colores2 = ["amarillo", "rojo", "negro"];

//Apartado f)
const informacionPersonal = {
    nombre: "Carlos",
    edad: 19,
    esEstudiante: true
};

//Apartado g)
console.log("Nombre: [", informacionPersonal.nombre, "]\n",
    "Edad: [", informacionPersonal.edad, "]\n",
    "Es estudiante: [", informacionPersonal.esEstudiante, "]",
);

//Apartado h)
edad += 5;

//Apartado i)
colores[0] = "naranja";
colores2[1] = "naranja";

//Apartado j)
console.log("Colores array 1:");
for(let color of colores){
    console.log(color);
}
console.log("Colores array 2:");
for(let color of colores2){
    console.log(color);
}

//Apartado k)
PI = 3.14;
//Esto dará un error porque PI es una constante y no se puede reasignar.

//Apartado l)
let numeroMagico;
numeroMagico = 7;
console.log("El número mágico es:", numeroMagico);
/*En este caso sí que me deja asignar el valor en otra
línea porque las variables let se pueden reasignar.*/

//Apartado m)
let numeroMagico2;
numeroMagico2 = 18;
console.log("El número mágico 2 es:", numeroMagico2);
/*En este caso también me deja asignarle el valor en otra
línea porque las variables let se pueden reasignar.*/

//Apartado n)
colores = ['violeta', 'púrpura', 'añil'];
/*Esto es posible porque las variables declaradas con
let pueden ser reasignadas a un nuevo array.*/

//Apartado o)
colores2 = ['violeta', 'púrpura', 'añil'];
/*Esto no es posible porque las variables declaradas con
const no pueden ser reasignadas a un nuevo array. Dará un error.*/