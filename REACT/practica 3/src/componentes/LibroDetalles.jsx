import React, { Fragment } from "react";
import "./LibroDetalles.css";
import sin_portada from "../assets/img/sin_portada.png";
import { NavLink, Link, useNavigate } from "react-router-dom";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCircleCheck, faCircleXmark } from "@fortawesome/free-regular-svg-icons";

const LibroDetalles = (props) => {
  const { titulo, autor, portada, completado, sinopsis } = props.libroBuscado;
  const navigate = useNavigate();

  return (
    <Fragment>
      <article className='libro-detalle'>
        <img
          className='libro-detalle__portada'
          src={portada ? portada : sin_portada}
          alt={titulo ? titulo : "No se ha especificado título."}
        />
        <div className='libro-detalle__info'>
          <div>

            <span className="libro-detalle__completado">
               {completado 
                 ? <FontAwesomeIcon icon={faCircleCheck} className="libro-detalle__completado--true" size="2x" />
                 : <FontAwesomeIcon icon={faCircleXmark} className="libro-detalle__completado--false" size="2x" />
               }
            </span>

            <span className='libro-detalle__titulo'>
              {titulo ? titulo : "No se ha especificado título."}
            </span>
          </div>

          <div className='libro-detalle__autor'>
            {autor ? autor : "No se ha especificado autor."}
          </div>
          <div className='libro-detalle__sinopsis'>
            {sinopsis ? sinopsis : "No se ha especificado sinopsis."}
          </div>

          <div className="botones-accion">

              <input 
                type="button" 
                value="Eliminar de la biblioteca" 
                className="boton boton--cancelar"
                onClick={() => navigate('/ruta-inexistente')} 
              />

              <input 
                type="button" 
                value="< Atrás" 
                className="boton boton--volver"
                onClick={() => navigate('/')} 
              />
          </div>

        </div>
      </article>
    </Fragment>
  );
};

export default LibroDetalles;