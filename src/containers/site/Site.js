import React, { Component } from 'react';
import Navbar from "../../components/UI/Navbar/NavBar";
import {Switch,Route} from "react-router-dom";
import Accueil from "./Accueil/Accueil";
//import Error from "../../components/Error/Error";
import CustomError from "../../components/Error/Error404";
import Footer from "../../components/Footer/Footer";
import Application from "./Application/Application";
import Contact from "./Contact/Contact";
import Error404 from "../../components/Error/Error404";


class Site extends Component {
    render() {
        return (
          <>
            <div className="site">
              <Navbar />
              <Switch>
                <Route path="/animaux" exact render={() => <Application />} />
                <Route path="/contact" exact render={() => <Contact />} />
                <Route path="/" exact render={() => <Accueil />} />
                <Route
                  render={() => (
                    <Error404 type="404">
                      La page que tu cherches n'existe pas
                    </Error404>
                  )}
                />
              </Switch>
            </div>
            <div className="minSite"></div>
            <Footer />
          </>
        );
    }
}
export default Site;
 