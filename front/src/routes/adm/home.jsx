import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { Outlet, useLocation } from "react-router-dom";
import { ErrorData } from "../../component/error/EmptyDataError";
import { AdmRoutes } from "../../component/menu/menu-h/adm/menuAdm";
import { PerfilAdm } from "../../component/screens/adm/perfil/perfil";
import { ProdutoProvider } from "../../contexts/ProdutoContext";
import { MainHome, Section } from "../../styles/routes/home/HomeStylesAdm";
import { Div, Hr } from "../../styles/ui/uis";

const dominio = process.env.API_KEY;
const cod = localStorage.getItem("cod_adm");

export function HomeAdm(){
    const [src, setSrc] = useState({})
    const path = useLocation();

    if(!cod){
        return <ErrorData message="Adm nao logado, por favor faça seu login" />
    }

    useEffect(()=>{
        const location = path.pathname.split("/")
        const line = document.querySelector(".line div");

        switch(location[3]){
            
            case "quantidade-produto-cadastrado":
                line.style.transform = "translateX(0)";
            break;
                
            case "produtos-cadastrados":
                line.style.transform = "translateX(100%)";
            break;
                    
            case "perfil":
                line.style.transform = "translateX(200%)";
            break;

            
            case "vendidos":
                line.style.transform = "translateX(300%)";
            break;
            
            case "vendidos_banho":
                line.style.transform = "translateX(400%)";
            break;
            
            default:
                line.style.transform = "translateX(0)";
                break;
        }
        
    }, [path.pathname])

    useEffect(()=>{
        if(cod){ 
            getAdm(cod).then(data =>{
                setSrc(data[0].photo)
            })
        }
    }, [cod])

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
            <ProdutoProvider>     
                <PerfilAdm src={src} />
                <Section>
                    <AdmRoutes />

                    <Div className="line">
                        <Hr />
                        <Div></Div>
                    </Div>

                    <Outlet />
                </Section>
            </ProdutoProvider>
        </MainHome>
    )
}