import React from 'react';
import Button from "../../../../components/UI/button/Button";


const animal = (props) => (
    <>
    <div className="card mb-3 mx-2">
            <h3 className="card-header">{props.id} - {props.nom}</h3>
            <button><a href="www.example.com" className="">Telecharger le {props.nom}</a></button>
        <div className="card-body">
            <div className="card-text">{props.description}</div>
        </div>
        <div className="cardStyle text-center">
            <img className="img-fluid h-100" src={props.image} alt={props.nom}/>
        </div>
        <div className="card-body">
            <h3>Famille : <Button typeBtn="btn-dark" click ={() => props.filtreFamille(props.famille.idFamille)} >{props.famille.libelleFamille.toUpperCase()}</Button></h3>
            <div>{props.famille.descriptionFamille}</div>
            
        </div>
        <div className="card-body">
            <h3>Continent : </h3>
            {
                props.continent.map(continent => {
                    let colorBtn="";
                    switch(continent.idContinent){
                        case "1": colorBtn ="btn-primary";
                        break;
                        case "2": colorBtn ="btn-danger";
                        break;
                        case "3": colorBtn ="btn-warning";
                        break;
                        case "4": colorBtn ="btn-success";
                        break;
                        case "5": colorBtn ="btn-info";
                        break;
                        default : colorBtn = "btn-secondary"

                    }
                    return <Button typeBtn={colorBtn} 
                    css="m-2"
                    click={() => props.filtreContinent(continent.idContinent)} 
                    key={continent.idContinent} 
                    >{continent.libelleContinent}
                    </Button>
                })
            }
        </div>
    </div>
    </>
);
  

export default animal;