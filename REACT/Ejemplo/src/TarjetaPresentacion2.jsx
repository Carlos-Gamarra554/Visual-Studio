import React from 'react';

function TarjetaPresentacion2({ nombre, profesion, descripcion }) {
  return (
    <div className="tarjeta">
      <h2>{nombre}</h2>
      <p className="profesion">{profesion}</p>
      <p className="descripcion">{descripcion}</p>
      <button>Seguir</button>
    </div>
  );
}

export default TarjetaPresentacion2;