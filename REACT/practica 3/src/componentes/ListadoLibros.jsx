import React, { Fragment } from "react";
import { Link } from "react-router-dom";
import Libro from "./Libro.jsx";
import biblioteca from "../assets/bd/biblioteca.json";
import "./ListadoLibros.css";

const ListadoLibros = () => {
  return (
    <Fragment>
      <div className="listado-libros-grid"> 
        
        {Array.isArray(biblioteca.libros) && biblioteca.libros.length ? (
          biblioteca.libros.map((datos_libro) => {
            return (
              <Link 
                to="/mostrar" 
                key={datos_libro.id} 
                className="listado_libro"
                style={{ textDecoration: 'none', color: 'inherit' }}
              >
                <Libro libro={datos_libro} />
              </Link>
            );
          })
        ) : (
          <p>No se han encontrado libros.</p>
        )}

      </div>
    </Fragment>
  );
};

export default ListadoLibros;