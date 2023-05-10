import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { IoPawSharp } from 'react-icons/io5';

export function Paws(){
    return(
        <div className={styles.container_paws}>
            <IoPawSharp style={{gridArea: "p1"}} id={styles.paws_icon}/>
            <IoPawSharp  style={{gridArea: "p6"}} id={styles.paws_icon}/>
            <IoPawSharp style={{gridArea: "p9"}} id={styles.paws_icon}/>
            <IoPawSharp style={{gridArea: "p3"}} id={styles.paws_icon}/>
            <IoPawSharp style={{gridArea: "p11"}} id={styles.paws_icon}/>
            <IoPawSharp  style={{gridArea: "p14"}} id={styles.paws_icon}/>
            <IoPawSharp  style={{gridArea: "p18"}} id={styles.paws_icon}/>
        </div>
    )
}