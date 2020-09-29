import React, { Component } from 'react';
import Navbar from "../../components/UI/Navbar/NavBar";
import {Switch,Route} from "react-router-dom";
import Accueil from "./Accueil/Accueil";
import Error from "../../components/Error/Error";
import Footer from "../../components/Footer/Footer";
import Application from "./Application/Application";


class Site extends Component {
    render() {
        return (
            <>
            <div className="site">
                <Navbar />
                <Switch>
                    <Route path="/animaux" exact render={()=> <Application />} />
                    <Route path="/contact" exact render={()=> <h1>je suis la page contact</h1>} />
                    <Route path="/"  exact render={()=> <Accueil/>} />
                    <Route  render={()=> <Error type="404">La page n'existe pas</Error>}/>
                </Switch>
            </div>
            <div className="minSite"></div>
             <Footer />
            </>
        );
    }
}
export default Site;
 