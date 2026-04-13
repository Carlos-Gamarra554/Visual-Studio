import React from 'react';
import { BrowserRouter } from 'react-router-dom';
import './App.css';
import Cabecera from './componentes/estructura/Cabecera';
import Navegacion from './componentes/estructura/Navegacion';
import Contenido from './componentes/estructura/Contenido';
import PiePagina from './componentes/estructura/PiePagina';

function App() {
  return (
    <BrowserRouter>
      <Cabecera />
      <Navegacion />
      <Contenido />
      <PiePagina />
    </BrowserRouter>
  );
}

export default App;