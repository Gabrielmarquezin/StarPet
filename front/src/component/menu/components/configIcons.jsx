import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { AiOutlineHeart } from 'react-icons/ai';
import { BsBasket2Fill } from 'react-icons/bs';
import { ContainerButtonSignin, ContainerProfile, Info, ProfileInfo, StyledLink, Triangle } from "../../../styles/menu/menu_styles";
import { useAuth } from "../../../hook/useAuth";
import { ButtonSignin } from "../../../styles/ui/uis";
import { Perfil } from "./perifl";

const dominio = process.env.API_KEY;

function Button(){
    const {signInWithPopUp} = useAuth()

    function SignIn(){
        signInWithPopUp().then(data => {
            cadastrar(data).then(response =>{
                localStorage.setItem("cod_user",parseInt(response.cod_user))
            })
        })
    }

   async function cadastrar({email, nome}){
        try{
            const request = await fetch(dominio+'/StarPet/backend/login', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                  },
                body: JSON.stringify(
                    {
                        nome: nome,
                        email: email,
                        photo: "",
                        bairro: "",
                        rua: "",
                        casa_numero: ""
                    }
                )
            })
            const response = await request.json();
            return JSON.parse(response)
        }catch(error){
            console.log(error)
        }
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

