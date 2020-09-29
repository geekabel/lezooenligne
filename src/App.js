import React from 'react';
import './App.css';
import Site from './containers/site/Site';
import {BrowserRouter} from "react-router-dom";


function App() {
  return (
    <BrowserRouter>
        <Site />
    </BrowserRouter>
 
  );
}

export default App;
