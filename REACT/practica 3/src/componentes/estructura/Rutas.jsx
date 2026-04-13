import React, { Fragment } from "react";
import { Routes, Route } from "react-router-dom";

import Inicio from "../paginas/Inicio";
import Crear from "../paginas/Crear";
import Buscar from "../paginas/Buscar";
import Error from "../paginas/Error";
import Mostrar from "../paginas/Mostrar";

const Rutas = () => {
  return (
    <Fragment>
      <Routes>
         <Route path="/" element={<Inicio />} />
         <Route path="/crear" element={<Crear />} />
         <Route path="/buscar" element={<Buscar />} />
         <Route path="/mostrar" element={<Mostrar />} />

         <Route path="*" element={<Error />} /> 
      </Routes>
    </Fragment>
  );
};
export default Rutas;