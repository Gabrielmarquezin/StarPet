import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { AiOutlineHeart } from 'react-icons/ai';
import { BsBasket2Fill } from 'react-icons/bs';
import { ContainerButtonSignin, ContainerProfile, Info, ProfileInfo, StyledLink, Triangle } from "../../../styles/menu/menu_styles";
import { useAuth } from "../../../hook/useAuth";
import { ButtonSignin } from "../../../styles/ui/uis";
import { Perfil } from "./perifl";


function Button(){
    const {signInWithPopUp} = useAuth()

    function SignIn(){
        signInWithPopUp()
    }

    return(
        <ContainerButtonSignin>
            <ButtonSignin onClick={SignIn}>Entrar/cadastrar</ButtonSignin>
        </ContainerButtonSignin>
    )
}

export function InfoIcon(){
    

    return (
       <div className={styles.container_icon_info}>
            <ContainerProfile>
                <Perfil />
                <ProfileOptions />
            </ContainerProfile>

            <AiOutlineHeart id={styles.icon}/>
            <BsBasket2Fill  id={styles.icon}/>
       </div>
    );
}

function ProfileOptions(){
    const {SignOutGoogle, user} = useAuth()
   
    function SignOut(){
        SignOutGoogle()
    }
    
    return(
        <ProfileInfo>
            <Triangle />
            {user == null ? <Button />
                :
            <>
                
                <Info>
                    <StyledLink color="#03045E" to={"#"}>Pefil</StyledLink>
                    <StyledLink color="#03045E" to={"/entrar"}>Favoritos</StyledLink>
                    <StyledLink color="#03045E" to={"#"} onClick={SignOut}>sair</StyledLink>
                </Info>
            </>}
        </ProfileInfo>
    )
}

