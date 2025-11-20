//Muestra un mensaje cuando se clica en las celdas si
let lista = document.querySelectorAll(".si");
lista.forEach((celdaSi)=>{
    celdaSi.addEventListener("click",(e)=>{
        let identificador = e.target.id;
        alert("Has hecho clic en: "+identificador);
    })
});

//Extraemos los elementos del DOM necesarios
let tabla=document.getElementsByTagName("table")[0];
let boton = document.getElementById("boton");

//Función para mostrar mensajes al clicar en las celdas "si"
function mensajes(event){
    let elemento = event.target;
    if(elemento.textContent==="si"){
        alert("Has hecho clic en: "+elemento.id);
    }
}

//Añadimos el gestor de eventos al botón para que se cree la nueva fila
boton.addEventListener("click",()=>{nuevaFila(tabla)});

//Añadimos el gestor de eventos a la tabla para mostrar mensajes al clicar es "si"
tabla.addEventListener("click",mensajes);