import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { IoPersonOutline } from 'react-icons/io5';
import { AiOutlineHeart } from 'react-icons/ai';
import { BsBasket2Fill } from 'react-icons/bs';

export function InfoIcon(){
    return (
       <div className={styles.container_icon_info}>
            <IoPersonOutline id={styles.icon}/>
            <AiOutlineHeart id={styles.icon}/>
            <BsBasket2Fill  id={styles.icon}/>
       </div>
    );
}