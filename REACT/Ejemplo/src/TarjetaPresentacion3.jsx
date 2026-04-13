import React from 'react';

function TarjetaPresentacion3({ nombre, profesion, children }) {
  return (
    <div className="tarjeta">
      <h2>{nombre}</h2>
      <div className="contenido-extra">
        {children}
      </div>

      <p>{profesion}</p>
      <button>Seguir</button>
    </div>
  );
}

export default TarjetaPresentacion3;