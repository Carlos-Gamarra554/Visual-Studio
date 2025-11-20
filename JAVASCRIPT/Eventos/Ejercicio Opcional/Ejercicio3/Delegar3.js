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

//Función para poner eventos a las nuevas filas insertadas
function ponerEvento(){
    let tblBody = tabla.firstElementChild;
    let numFilas = tblBody.children.length;
    let numCeldasFila = tblBody.firstElementChild.children.length;
    let ultimaFilaTabla = tblBody.children[numFilas-1];
    let celdasFila = ultimaFilaTabla.children;

    //Recorremos las celdas de la última fila y añadimos el evento a las "si"
    for (let j = 0; j <= numCeldasFila-1; j++) {
        if(celdasFila[j].textContent==="si"){
            celdasFila[j].addEventListener("click",(e)=>{
                let identificador = e.target.id;
                alert("Has hecho clic en: "+identificador);
            });
        }
    }
}

//Añadimos el gestor de eventos al botón para que se cree la nueva fila
boton.addEventListener("click",()=>{nuevaFila(tabla)});

//Añadimos otro gestor de eventos para poner los eventos a las nuevas filas
boton.addEventListener("click", ponerEvento)