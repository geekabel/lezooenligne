import React, { Component } from 'react';
import TitreH1 from "../../../components/UI/Titres/TitreH1";
import axios from "axios";
import Animal from "../Application/Animal/Aninal";
import Button from "../../../components/UI/button/Button";

class Application extends Component {
   state  = {
       animaux : null,
       filtreFamille: null,
       filtreContinent: null,
       listFamilles: null,
       listContinents: null
   }
    //Load all data from my server//depuis mon server php
    loadData = () => {
        const famille = this.state.filtreFamille ? this.state.filtreFamille :"-1";
        const continent = this.state.filtreContinent ? this.state.filtreContinent :"-1";
        axios.get(`http://localhost/Projetfinal/serveurAnimaux/front/animaux/${famille}/${continent}`)
        .then(response => {
            this.setState({animaux :Object.values(response.data) })
            //console.log(response.data);
})
   }
    
   componentDidMount =() => {
       this.loadData();

       axios.get(`http://localhost/Projetfinal/serveurAnimaux/front/continents`)
            .then(response => {
                this.setState({listContinents :Object.values(response.data) });
            })
       axios.get(`http://localhost/Projetfinal/serveurAnimaux/front/familles`)
           .then(response => {
               this.setState({listFamilles :Object.values(response.data) });
           })
   }

   componentDidUpdate = (oldProps,oldState) => {
       if(oldState.filtreFamille !== this.state.filtreFamille || oldState.filtreContinent !== this.state.filtreContinent ){
            this.loadData();
       }
       
   }
   //Prochaine etape : affichage d'un message lorsqu"on ne trouve rien correspondant au filtre (A faire )
   
   

   // filtre pour la selection des familles
   handleSelectionFamille = (idFamille) => {
       if(idFamille ==="-1") this.handleSelectionFamille();
       else this.setState({filtreFamille : idFamille});
       //console.log(`Demande de ${idFamille}`);
   }
   //filtre pour la selection des continents
   handleSelectionContinent = (idContinent) => {
    if(idContinent ==="-1") this.handleSelectionContinent();
    else this.setState({filtreContinent : idContinent});
    //console.log(`Demande de ${idContinent}`);
    }
    
    // filterNotFoud = () => {
    // if(!this.state.filtreFamille && !this.state.filtreContinent){
    //     console.log("je n'ai rien trouve comme filtre");
    // }  
    // }
    // gerer mon event 
    // handleChange(event){
    //     //this.setState({})
    //     this.handleSelectionContinent(event.target.value)
    // }



    handleResetFiltreFamille =  () =>{
        this.setState({filtreFamille:null});
       }

    handleResetFiltreContinent =  () =>{
        this.setState({filtreContinent :null});
       }

    render() { 
        //afficher le nom correspondant a mon id Filtre Famille 
        let nomFamilleFiltre ="";
        if(this.state.filtreFamille){
        const numCaseFamilleFiltre = this.state.listFamilles.findIndex(famille =>{
            return famille.famille_id ===  this.state.filtreFamille;
        })
            nomFamilleFiltre = this.state.listFamilles[numCaseFamilleFiltre].famille_libelle
        }

        //afficher le nom correspondant a mon id filtre continent 
        let nomContinentFiltre ="";
        if(this.state.filtreContinent){
        const numCaseContinentFiltre = this.state.listContinents.findIndex(continent =>{
            return continent.continent_id ===  this.state.filtreContinent;
        })
            nomContinentFiltre = this.state.listContinents[numCaseContinentFiltre].continent_libelle
        }
        return ( 
            <>
                <TitreH1 bgColor="bg-success">Les animaux du parc</TitreH1>
                <div className="container-fluid">
                <span>Filtres :  </span>
                 <select onChange={(event) => this.handleSelectionFamille(event.target.value)}>
                    <option value="-1"
                     selected={this.state.filtreFamille===null && "selected"}
                    >Familles</option>
                    {
                        this.state.listFamilles && this.state.listFamilles.map(famille =>{
                            return <option value={famille.famille_id}
                            selected={this.state.filtreFamille===famille.famille_id && "selected"}
                            >{famille.famille_libelle}</option>
                        })
                    }
                 </select>
                 <select className="mx-2 my-2" onChange={(event) => this.handleSelectionContinent(event.target.value)}>
                    <option value="-1"
                     selected={this.state.filtreContinent===null && "selected"}
                    >Continent</option>
                    {
                        this.state.listContinents && this.state.listContinents.map(continent =>{
                            return <option value={continent.continent_id}
                            selected={this.state.filtreContinent===continent.continent_id && "selected"}
                            >{continent.continent_libelle}</option>
                        })
                    }
                 </select>
                
                {
                    this.state.filtreFamille &&
                    <Button 
                    typeBtn="btn-secondary" click = {this.handleResetFiltreFamille}
                    
                    >{nomFamilleFiltre} &nbsp;
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    </Button>
                }

                {
                    this.state.filtreContinent &&
                    <Button 
                    typeBtn="btn-secondary" click = {this.handleResetFiltreContinent}
                    >{nomContinentFiltre}&nbsp;
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    </Button>
                }

                </div>    
                
               
                <div className="container-fluid">
                <div className="row no-gutters">
                    {
                        this.state.animaux &&
                        this.state.animaux.map(animal => {
                            return (
                                <div className="col-12 col-md-6 col-xl-4" key={animal.id}>
                                    <Animal {...animal}  filtreFamille={this.handleSelectionFamille} 
                                            filtreContinent = {this.handleSelectionContinent}
                                      />
                                </div>
                                
                            )
                        })
                    }
                </div>
                </div>
            </>
         );
    }
}
 
export default Application;