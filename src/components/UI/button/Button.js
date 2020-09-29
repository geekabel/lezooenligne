import React from 'react';

const button = (props) => {
    let btnCss = `btn ${props.typeBtn} ${props.css}`
    return <button  className={btnCss} onClick={props.click} >{props.children}</button>

};
     
export default button;