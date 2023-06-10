import React from "react";
import { createContext } from "react";
import { useEffect } from "react";
import { useState } from "react";
import { FooterMin } from "../../component/footer/footer";
import { UserPerfil } from "../../component/form/PerfilForm/components/input";
import { FormPerfil } from "../../component/form/PerfilForm/form";
import { MenuPerfil } from "../../component/menu/menu-v/myPerfil/MenuPerfil";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import { MainPerfil, SectionForm, SectionMenu, StyleForm } from "../../styles/routes/perfil/PerfilStyles";
import { P } from "../../styles/ui/uis";
import { AiOutlineClose } from "react-icons/ai";
import { Link } from "react-router-dom";

const dominio = process.env.API_KEY;

async function FetchUser(){
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    const cod = params.get("cod")

    try {
        const request = await fetch(dominio+`/StarPet/backend/users?cod=${cod}`)
        const response = await request.json();

        return response;
    } catch (error) {
        console.log(error)
    }
}

export const PerfilContext = createContext();
function MyPerfil({data}){
    const [user, setUser] = useState(data);
   
    useEffect(()=>{
        setUser(data)
    }, [])

    return(
       <PerfilContext.Provider value={{DataUser: user}}>
          <MainPerfil>
                <SectionMenu>
                    <UserPerfil />
                    <MenuPerfil />
                    <FooterMin />
                </SectionMenu>

                <SectionForm>
                   <StyleForm className="ui-style-form-perfil">
                        <P>PERFIL</P>
                        <FormPerfil />
                   </StyleForm>
                   <Link to={"/"}><AiOutlineClose  size={35} /></Link>
                </SectionForm>
            </MainPerfil>
       </PerfilContext.Provider>
    )
}

export const MyPerfilWithLoading = withLoadingAndFetch(MyPerfil, FetchUser)