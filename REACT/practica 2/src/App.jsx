import React from 'react';
import './App.css';
import Cabecera from './componentes/estructura/Cabecera';
import Navegacion from './componentes/estructura/Navegacion';
import Contenido from './componentes/estructura/Contenido';
import PiePagina from './componentes/estructura/PiePagina';

function App() {
  return (
    <>
      <Cabecera />
      <Navegacion />
      <Contenido />
      <PiePagina />
    </>
  );
}

export default App;