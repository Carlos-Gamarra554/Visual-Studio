    // Array con los nombres de los meses
    const nombresMeses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    //Array con los nombres de los días de la semana
    const diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];

    //Inicialización de variables necesarias para las funciones
    const selectorMes = document.getElementById("selectorMes");
    const selectorAnio = document.getElementById("selectorAnio");
    const botonAnterior = document.getElementById("anteriorMes");
    const botonSiguiente = document.getElementById("siguienteMes");
    const calendario = document.getElementById("calendario");

    const fechaActual = new Date();
    const anoActual = fechaActual.getFullYear();
    const mesActual = fechaActual.getMonth();
    const diaActual = fechaActual.getDate();

    let diaSeleccionado = null;


//Función para rellenar la información de los seleccionadores de mes y año
function rellenarSeleccionadores() {
    nombresMeses.forEach((mes, indice) => {
        const opcion = document.createElement('option');
        opcion.value = indice;
        opcion.textContent = mes;
        selectorMes.appendChild(opcion);
    });

    const anioInicio = anoActual - 10;
    const anioFinal = anoActual + 10;
    for(let anio = anioFinal; anio >= anioInicio; anio--){
        const opcion = document.createElement('option');
        opcion.value = anio;
        opcion.textContent = anio;
        selectorAnio.appendChild(opcion);
    }
}

//Función para agregar los eventos a los elementos del calendario
function agregarGestorEventos(){
    //Selectores de mes y año
    selectorMes.addEventListener('change', actualizarCalendario);
    selectorAnio.addEventListener('change', actualizarCalendario);

    //Botones de cambio de mes
    botonAnterior.addEventListener('click', () => cambiarMes(-1));
    botonSiguiente.addEventListener('click', () => cambiarMes(1));

    //Delegación de eventos del calendario para seleccionar un día
    calendario.addEventListener('click', seleccionarDia);
}

//Función para actualizar el calendario cuando se cambie la fecha
function actualizarCalendario() {
    const mes = parseInt(selectorMes.value);
    const anio = parseInt(selectorAnio.value);
    crearCalendario(anio, mes);
}

//Función para crear el calendario a partir del año y del mes
function crearCalendario(ano, mes) {   
    const primerDiaDelMes = new Date(ano, mes, 1);
    let diaSemanaInicio = primerDiaDelMes.getDay();
    let indiceDiaInicio = (diaSemanaInicio === 0) ? 6 : diaSemanaInicio - 1;
    const ultimoDiaDelMes = new Date(ano, mes + 1, 0).getDate();
    const ultimoDiaMesAnterior = new Date(ano, mes, 0).getDate();

    //Empezamos a crear la tabla
   let html = '<table>';

    // Fila 1: Nombre del Mes y Año
    html += `<tr>
                <th colspan="7" class="encabezado">
                    ${nombresMeses[mes]} ${ano}
                </th>
            </tr>`;

    //Fila 2: días de la semana
    html += `<tr class="dias-semana">`;
    diasSemana.forEach(dia => html += `<th>${dia}</th>`);
    html += `</tr>`;

    let dia = 1;
    let diaSiguiente = 1;

    for (let i = 0; i < 6; i++) {
        if (dia > ultimoDiaDelMes) {
            break;
        }

        html += '<tr>';

        //Comprobaciones para los días
        //Ver si es del mes anterior
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < indiceDiaInicio) {
                let diaAnterior = (ultimoDiaMesAnterior - indiceDiaInicio) + 1 + j;
                html += `<td class="otro-mes"><div class="dia">${diaAnterior}</div></td>`;
                
            //Ver si es de este mes
            } else if (dia <= ultimoDiaDelMes) {
                let clase = 'day';

                //Ver si el día es hoy
                if (dia === diaActual && mes === mesActual && ano === anoActual) {
                    clase += ' hoy'
            }

            //Ver si el día está seleccionado
            if(diaSeleccionado && dia === diaSeleccionado.getDate() && mes === diaSeleccionado.getMonth() && ano === diaSeleccionado.getFullYear()){
                clase += ' seleccionado';
            }

            //Crear la celda del día con la clase correspondiente
            html += `<td class="${clase}" data-day="${dia}">
                        <div class="textoDia">${dia}</div>
                    </td>`;
            dia++;

        } else {
            //Si no se cumple la condición es un día del mes siguiente
            html += `<td class="otro-mes"><div class="dia">${diaSiguiente}</div></td>`;
            diaSiguiente++;
        }
    }
        //Cerrar la fila
        html += '</tr>';
    }

    //Cerrar la tabla y escribirla en el html
    html += '</table>';
    calendario.innerHTML = html;
}

//Función para cambiar entre meses
function cambiarMes(num) {
    const mesActual = parseInt(selectorMes.value);
    const anioActual = parseInt(selectorAnio.value);

    const nuevaFecha = new Date(anioActual, mesActual, 1);
    nuevaFecha.setMonth(nuevaFecha.getMonth() + num);

    const nuevoAnio = nuevaFecha.getFullYear();
    const nuevoMes = nuevaFecha.getMonth();

    //Actualizar los valores de los <select>
    if(selectorAnio.querySelector(`option[value="${nuevoAnio}"]`)) {
        selectorAnio.value = nuevoAnio;
        selectorMes.value = nuevoMes;
    } else {
        //Si el año no se encuentra en la lista, no hacemos nada
        console.warn(`El año ${nuevoAnio} no está en la lista.`);
    }
    actualizarCalendario();
}

//Función para cuando se seleccione un día del calendario
function seleccionarDia(event) {
    const celdaSeleccionada = event.target.closest('td');

    //Si no se ha hecho clic en una celda todavía o el dia seleccionado no existe, no hace nada
    if(!celdaSeleccionada || !celdaSeleccionada.dataset.day) {
        return;
    }

    const diaClicado = parseInt(celdaSeleccionada.dataset.day);
    const ValorMes = parseInt(selectorMes.value);
    const ValorAnio = parseInt(selectorAnio.value);

    diaSeleccionado = new Date(ValorAnio, ValorMes, diaClicado);

    const diaFormateado = String(diaClicado).padStart(2, '0');
    const nombreMes = nombresMeses[ValorMes];
    console.log(`Día seleccionado: ${diaFormateado} de ${nombreMes} de ${ValorAnio}`);

    actualizarCalendario();
}

//Ejecutamos las funciones para inicializar el calendario
rellenarSeleccionadores();
agregarGestorEventos();

selectorMes.value = mesActual;
selectorAnio.value = anoActual;

crearCalendario(anoActual, mesActual);