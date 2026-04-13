import React from 'react';
import './App.css';
import TarjetaPresentacion1 from './TarjetaPresentacion1';
import TarjetaPresentacion2 from './TarjetaPresentacion2';
import TarjetaPresentacion3 from './TarjetaPresentacion3';

function App() {
  return (
    <div className="App">
      <h1>Tarjetas de Presentación</h1>

      <h3>Ejercicio 1</h3>
      <div>
        <TarjetaPresentacion1 />
        <TarjetaPresentacion1 />
      </div>

      <h3>Ejercicio 2</h3>
      <div>
        <TarjetaPresentacion2 
          nombre="Ana García" 
          profesion="Diseñadora UX" 
          descripcion="Apasionada por crear experiencias de usuario intuitivas."
        />
        <TarjetaPresentacion2 
          nombre="Carlos López" 
          profesion="Backend Dev" 
          descripcion="Experto en Node.js y bases de datos."
        />
      </div>

      <h3>Ejercicio 3</h3>
      <TarjetaPresentacion3 nombre="Laura M." profesion="Data Scientist">
        <span>
          ⭐ Empleado del mes
        </span>
      </TarjetaPresentacion3>
    </div>
  );
}

export default App;