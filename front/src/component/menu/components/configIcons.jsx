import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { AiOutlineHeart } from 'react-icons/ai';
import { BsBasket2Fill } from 'react-icons/bs';
import { ContainerButtonSignin, ContainerProfile, Info, ProfileInfo, StyledLink, Triangle } from "../../../styles/menu/menu_styles";
import { useAuth } from "../../../hook/useAuth";
import { ButtonSignin } from "../../../styles/ui/uis";
import { Perfil } from "./perifl";
import { useNavigate } from "react-router-dom";
import Swal from "sweetalert2";

const dominio = process.env.API_KEY;

function Button(){
    const {signInWithPopUp} = useAuth()

    function SignIn(){
        signInWithPopUp().then(data => {
            cadastrar(data).then(response =>{
                localStorage.setItem("cod_user",parseInt(response.cod_user))
                localStorage.setItem("favorites", "[]");
                localStorage.setItem("carrinho", "[]");
            })
        })
    }

   async function cadastrar({email, displayName}){
        try{
            const request = await fetch(dominio+'/StarPet/backend/login', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                  },
                body: JSON.stringify(
                    {
                        nome: displayName,
                        email: email,
                        photo: "",
                        bairro: "",
                        rua: "",
                        casa_numero: ""
                    }
                )
            })
            const response = await request.json();

            return response
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
    const {user} = useAuth();
    const navigate = useNavigate();

    function goFavorites(){
        if(!user){
            Swal.fire({
                title: "Você não esta logado",
                text: "por favor faça seu login",
                icon: "error",
                confirmButtonText: "OK"
            })
            return
        }

        const cod_user = localStorage.getItem("cod_user")
        navigate(`perfil/favorite/user?cod=${cod_user}`)
    }

    function goCarrinho(){
        if(!user){
            Swal.fire({
                title: "Você não esta logado",
                text: "por favor faça seu login",
                icon: "error",
                confirmButtonText: "OK"
            })
            return
        }

        const cod_user = localStorage.getItem("cod_user")
        navigate(`/perfil/carrinho/user?cod=${cod_user}`)
    }

    return (
       <div className={styles.container_icon_info}>
            <ContainerProfile>
                <Perfil />
                <ProfileOptions />
            </ContainerProfile>

            <AiOutlineHeart id={styles.icon} onClick={goFavorites} />
            <BsBasket2Fill  id={styles.icon} onClick={goCarrinho} />
       </div>
    );
}

function ProfileOptions(){
    const {SignOutGoogle, user} = useAuth()
    const codUser = localStorage.getItem("cod_user")

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
                    <StyledLink color="#03045E" to={`perfil/user?cod=${codUser}`}>Pefil</StyledLink>
                    <StyledLink color="#03045E" to={`perfil/favorite/user?cod=${codUser}`}>Favoritos</StyledLink>
                    <StyledLink color="#03045E" to={"#"} onClick={SignOut}>sair</StyledLink>
                </Info>
            </>}
        </ProfileInfo>
    )
}

