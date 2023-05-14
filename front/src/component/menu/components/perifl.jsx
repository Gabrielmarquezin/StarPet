import React from "react";
import { IoPersonOutline } from "react-icons/io5";
import { useAuth } from "../../../hook/useAuth";
import {ImagePerfil, Profile } from "../../../styles/menu/menu_styles";
import styles from "../../../styles/menu/styles.module.css";

export function Perfil(){
    const {user} = useAuth();

    let click = 0;

    function handleProfileOptions(){
        const element = document.querySelector('.profile_info');
        const profile = document.querySelector('.profile');
        if(click%2 == 0){
            element.style.maxHeight = "100px"
            
        }else{
            element.style.maxHeight = "0px"
        }

        profile.classList.toggle("profile-event")
        click++
    }

    function renderPhoto(e){
        e.target.classList.toggle("profile-loading")
    }

    return(
        <ImagePerfil>
            {user == null ? <IoPersonOutline id={styles.icon} className="profile" onClick={handleProfileOptions}/>
                :
            <Profile src={user.photoURL} alt={""} onClick={handleProfileOptions} onLoad={renderPhoto}/>
            }
        </ImagePerfil>
    )
}