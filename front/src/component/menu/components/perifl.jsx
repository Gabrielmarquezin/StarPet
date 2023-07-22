import React, { useState } from "react";
import { useEffect } from "react";
import { IoPersonOutline } from "react-icons/io5";
import { useAuth } from "../../../hook/useAuth";
import {ImagePerfil, Profile } from "../../../styles/menu/menu_styles";
import styles from "../../../styles/menu/styles.module.css";

const dominio = process.env.API_KEY;

export function Perfil(){
    const {user} = useAuth();
    const [photo, setPhoto] = useState("");

    let click = 0;

    useEffect(()=>{
        if(user !== null && Object.keys(user).length !== 0){
            const cod_user = localStorage.getItem("cod_user")
            fetch(dominio+`/StarPet/backend/users?cod=${cod_user}`)
            .then(data => data.json())
            .then(data => {
                setPhoto("data:image/jpeg;base64,"+data[0].photo)
            })
            .catch(error => {
                console.log(error)
            })
        }
    }, [user])

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
      e.target.classList.remove("profile-loading")
    }
    
    function ImgError(e){
        e.target.classList.remove("profile-loading")
        e.target.src = user.photoURL
    }

    return(
        <ImagePerfil>
            {user == null ? <IoPersonOutline id={styles.icon} className="profile" onClick={handleProfileOptions}/>
                :
            <Profile src={photo} alt={""} onClick={handleProfileOptions} onLoad={renderPhoto} onError={ImgError}/>
            }
        </ImagePerfil>
    )
}