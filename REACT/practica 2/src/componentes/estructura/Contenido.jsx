import React, { Fragment } from "react";
import ListadoLibros from "../ListadoLibros.jsx"; 
import "./Contenido.css";

const Contenido = () => {
  return (
    <Fragment>
      <main className="main">
        <ListadoLibros />
      </main>
    </Fragment>
  );
};

export default Contenido;