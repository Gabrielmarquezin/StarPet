import React from "react";
import { useState, useContext } from "react";
import { useEffect } from "react";
import {Main} from "../../styles/routes/produto/ProdutoStyle";
import { Footer } from "../../component/footer/footer";
import { SectionOptions, SectionOptionsPet } from "../../component/screens/produto/sectionOptions";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import {ContainerSectionComentario } from "../../component/screens/produto/SectionComments";
import { Hr} from "../../styles/ui/uis";
import { InputMsg } from "../../component/screens/produto/Input";
import { FichaPet } from "../../component/table/produto/table";
import { PetContext } from "./Pet";
import { SectionPet } from "../../component/screens/produto/mainAdocao";


const dominio = process.env.API_KEY;
const socket = new WebSocket("ws://localhost:3001/produto");

async function fetchData(){
    const id = window.location.pathname.split("/").pop();
    
    try{
        const request = await fetch(dominio+`/StarPet/backend/products/pet/adocao?id=${id}`);
        const produto = await request.json();

        return produto;
    }catch(error){
        console.log(error)
    }
}

export function PetAdocao({data}){
    const [produto, setProduto] = useState([]);
    
    useEffect(()=>{

        setProduto(data)
    }, [])

    return (
       <PetContext.Provider value={{data: produto}}>
            <Main>
                <SectionPet />
                <Hr />

                <SectionOptionsPet>
                    {produto.length !== 0 && <FichaPet data={produto[0]}/>}
                </SectionOptionsPet>
                <Hr />  
            
               <InputMsg /> 
                <Hr />
            </Main>
            <Footer />
       </PetContext.Provider>
    )
}

export const PetAdocaoWithLoading = withLoadingAndFetch(PetAdocao, fetchData);