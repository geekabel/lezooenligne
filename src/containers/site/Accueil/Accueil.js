import React, { Component } from 'react';
import TitreH1 from "../../../components/UI/Titres/TitreH1";
import banderole from "../../../assets/images/banderole.png";
import logo from "../../../assets/images/zoo.png";

class Accueil extends Component {
    componentDidMount = () => {
        document.title = "Parc d'animaux myzoo";
    }

    render() { 
        return ( 
            <div>
             <img src={banderole} alt="banderole" className="img-fluid"/>
                <TitreH1>Accueil</TitreH1>
                <div className="container">
                <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat reiciendis voluptatum vel aliquam doloribus ? 
                Totam facere a alias dicta qui, enim delectus sapiente unde porro inventore provident? Provident, magnam sunt ?
                </p>
                <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat reiciendis voluptatum vel aliquam doloribus ? 
                Totam facere a alias dicta qui, enim delectus sapiente unde porro inventore provident? Provident, magnam sunt ?
                </p>
               <div className="row no-gutters align-items-center">
                    <div className="col-12 col-md-6">
                        <img src={logo} alt="logo du site" className="img-fluid" />
                    </div>
                    <div className="col-12 col-md-6">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat reiciendis voluptatum vel aliquam doloribus ? 
                        Totam facere a alias dicta qui, enim delectus sapiente unde porro inventore provident? Provident, magnam sunt ?
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat reiciendis voluptatum vel aliquam doloribus ? 
                        Totam facere a alias dicta qui, enim delectus sapiente unde porro inventore provident? Provident, magnam sunt ?
                    </div>
                    <div className="col-12 col-md-6">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat reiciendis voluptatum vel aliquam doloribus ? 
                        Totam facere a alias dicta qui, enim delectus sapiente unde porro inventore provident? Provident, magnam sunt ?
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat reiciendis voluptatum vel aliquam doloribus ? 
                        Totam facere a alias dicta qui, enim delectus sapiente unde porro inventore provident? Provident, magnam sunt ?
                    </div>
                    <div className="col-12 col-md-6">
                        <img src={logo} alt="logo du site" className="img-fluid" />
                    </div>
                </div>
                </div>
            </div>
         );
    }
}
 
export default Accueil;