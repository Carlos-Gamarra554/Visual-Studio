import React, { Fragment } from "react";
import "./PiePagina.css"; // Importar estilo

const PiePagina = () => {
  return (
    <Fragment>
      <footer className="pie">
        <small className="pie__texto"> 
          Curso 24A132CF029 Programación reactiva para aplicaciones Web (React).
        </small>
      </footer>
    </Fragment>
  );
};

export default PiePagina;