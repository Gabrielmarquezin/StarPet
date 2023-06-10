import React, { useEffect, useState } from "react";
import { MainHome } from "../../../styles/routes/home/HomeStylesAdm";
import { ErrorData } from "../../error/EmptyDataError";
import { PerfilAdm } from "./perfil/perfil";

const cod_adm = localStorage.getItem("cod_adm");
const dominio = process.env.API_KEY;

export function AdmMenuV({children}){

    const [src, setSrc] = useState('');

    if(!cod_adm){
        return <ErrorData message="Adm nao logado, por favor faça seu login" />
    }
    
    useEffect(()=>{
        if(cod_adm){ 
            getAdm(cod_adm).then(data =>{
                setSrc(data[0].photo)
            })
        }
    }, [cod_adm])

    async function getAdm(cod){
        try {
            const request = await fetch(dominio+`/StarPet/backend/users?cod=${cod}`)
            const response = await request.json();

           return response;
        } catch (error) {
            console.log(error)
        }
    }
    return(
        <MainHome>
            <PerfilAdm src={src}/>
            {children}
        </MainHome>
    )
}