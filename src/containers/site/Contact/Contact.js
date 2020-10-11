import React, { Component } from 'react';
import Titre from "../../../components/UI/Titres/TitreH1";
import Formulaire from "./Formulaire/Formulaire";
import axios from "axios";

class Contact extends Component {
    componentDidMount = () =>{
        document.title = "Page de contact";
    }
    handleSendMail = (message) =>{
        axios.post("http://localhost/Projetfinal/serveurAnimaux/front/sendMessage",message)
             .then(response=>{
                 console.log(response);
             })
             .catch(error =>{
                 console.log(error);
             })
        console.log(message);
    }
    render() { 
        return ( 
            <>
                    <Titre bgColor="bg-success">Contact nous !</Titre>
                    <div className="container">
                        <h2>Adresse : </h2>
                        xxxxxxxxxxxxxxxxxxxxxxxx
                        <h2>Telephone</h2>
                        00 00 00 00 00
                        <h2>Vous préférez nous écrire ?</h2>
                        <Formulaire sendMail = {this.handleSendMail}/>
                    </div>
            </>
         );
    }
}
 
export default Contact;