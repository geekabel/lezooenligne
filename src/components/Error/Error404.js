import React from "react";
import TitreH1 from "../UI/Titres/TitreH1";
import bart404 from "../../../src/assets/images/bart-404.jpg";
const Error404 = (props) => (
  <>
    <TitreH1 bgColor="bg-danger">Erreur {props.type}</TitreH1>
    <div className="container">
      <h1>{props.children}</h1>
      <img src={bart404} alt="bart simpson" className="img-fluid" />
      
    </div>
  </>
);

export default Error404;
