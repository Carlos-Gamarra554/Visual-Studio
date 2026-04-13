import React, { Fragment } from "react";
import "./Navegacion.css";

const Navegacion = () => {
  return (
    <Fragment>
      <nav className="menu">
        <ul className="menu__lista">
          <li className="menu__item">
            <a href="#" className="menu__link">Inicio</a>
          </li>
          <li className="menu__item">
            <a href="#" className="menu__link">Crear libro</a>
          </li>
          <li className="menu__item">
            <a href="#" className="menu__link">Buscar libros</a>
          </li>
        </ul>
      </nav>
    </Fragment>
  );
};

export default Navegacion;