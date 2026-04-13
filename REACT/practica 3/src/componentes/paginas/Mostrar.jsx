import React, { Fragment } from "react";
import LibroDetalles from "../LibroDetalles.jsx";

const Mostrar = () => {
  const libro = {
    id: "85f06643-f095-4a85-9d93-b9a78eb48r54",
    titulo: "Yo, robot",
    autor: "Isaac Asimov",
    portada: "https://imagessl0.casadellibro.com/a/l/t7/40/9788435021340.jpg",
    completado: false,
    sinopsis: "Esta obra visionaria tuvo una gran influencia en la ciencia ficción posterior..."
  };

  return (
    <Fragment>
      <section className="mostrar">
           <LibroDetalles libroBuscado={libro} />
           : "No se ha encontrado ningún libro."
      </section>
    </Fragment>
  );
};

export default Mostrar;