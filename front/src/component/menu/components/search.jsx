import React from "react";
import { Input } from "../../../styles/menu/menu_styles";
import styles from "../../../styles/menu/styles.module.css";
import { CiSearch } from "react-icons/ci";

export function Search(){
    return(
        <div className={styles.search_container}>
            <Input type={"text"} />
            <CiSearch id={styles.icon_search}/>
        </div>
    )
}