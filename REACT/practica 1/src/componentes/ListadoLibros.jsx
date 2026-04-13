import React, { Fragment } from "react";
import Libro from "./Libro.jsx";
import biblioteca from "../assets/bd/biblioteca.json";

const ListadoLibros = () => {
  return (
    <Fragment>
      <h2>Listado de libros</h2>

      {Array.isArray(biblioteca.libros) && biblioteca.libros.length ? (
        biblioteca.libros.map((datos_libro) => {
          return (
            <Libro
              key={datos_libro.id}
              libro={datos_libro}
            />
          );
        })
      ) : (
        <p>No se han encontrado libros.</p>
      )}
    </Fragment>
  );
};

export default ListadoLibros;