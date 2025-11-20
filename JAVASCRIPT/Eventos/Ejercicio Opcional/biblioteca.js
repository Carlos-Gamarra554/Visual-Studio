//Función para crear una nueva fila en la tabla al pulsar el botón
function nuevaFila(tabla){
    let tblBody = tabla.firstElementChild;
    let numCeldas = tblBody.firstElementChild.children.length;

    let hilera = document.createElement("tr");

    for (let j = 0; j <= numCeldas-1; j++) {
      let celda = document.createElement("td");
      if(Math.random()>=0.5) textoCelda=document.createTextNode("si");
      else textoCelda=document.createTextNode("NO");
      celda.appendChild(textoCelda);
      celda.id=`n${tblBody.children.length*numCeldas+j}`;
      hilera.appendChild(celda);
    }

    tblBody.appendChild(hilera);
}