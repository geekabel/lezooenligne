import React from 'react';
import facebook from "../../assets/images/footer/facebook.png";
import twitter from "../../assets/images/footer/twitter.png";
import instagram  from "../../assets/images/footer/instagram.png";
import {NavLink} from "react-router-dom";
import classes from "./Footer.module.css"

const Footer = (props) => (
    <>
        <footer className="bg-primary ">
            <div className="text-white text-center" >Myzoo- tout droit reserves</div>
            <div className="row no-gutters align-items-center text-center pt-2" >
                <div className="col-3">
                    <a href="www.example.com" className="d-block" target="_blank">
                        <img src={facebook} alt='facebook' className="imgFB"/>
                    </a>
                </div>
                <div className="col-3">
                    <a href="www.example.com" className="d-block" target="_blank">
                        <img src={twitter} alt='twitter' className="imgTwitter"/>
                    </a>
                </div>
                <div className="col-3">
                    <a href="www.example.com" className="d-block" target="_blank">
                        <img src={instagram} alt='instagram' className="imgIST"/>
                    </a>
                </div>
                <div className="col-3">
                   <NavLink to="/mentionLegales" className={["nav-link", "p-0", "m-0",classes.p_footerLink].join(" ")}>Mentions Legales</NavLink>
                   <a href="mailto:contact@myzoo.com" className={["nav-link", "p-0", "m-0",classes.p_footerLink].join(" ")}>contact@myzoo.com</a>
                </div>
            </div>
        </footer>
    </>
)
 
export default Footer ;