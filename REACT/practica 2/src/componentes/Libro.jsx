import React, { Fragment } from "react";
import sin_portada from "../assets/img/sin_portada.png";

const Libro = ({ libro }) => {

  const { id, titulo, autor, portada } = libro;

  return (
    <Fragment>
       {/* Usamos randomUUID si no hay ID [cite: 282] */}
      <article id={id ? id : crypto.randomUUID()}>
        <img
          width="150px"
          height="225px"
          src={portada ? portada : sin_portada} 
          alt={titulo}
        />
        <div>{titulo ? titulo : "No se ha especificado título."}</div>
        <div>{autor ? autor : "No se ha especificado autor."}</div>
      </article>
    </Fragment>
  );
};

export default Libro;