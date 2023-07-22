import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useEffect } from "react";
import {Main, SectionCarrossel} from "../../styles/routes/produto/ProdutoStyle";
import Image from "../../assets/1.jpeg";
import { Footer } from "../../component/footer/footer";
import { Carrossel } from "../../component/carrossel/carrossel";
import { SectionOptionsPet } from "../../component/screens/produto/sectionOptions";
import { SectionPet, SectionProduto } from "../../component/screens/produto/main";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import {ContainerSectionComentario } from "../../component/screens/produto/SectionComments";
import { Hr} from "../../styles/ui/uis";
import { InputMsg } from "../../component/screens/produto/Input";
import { FichaPet } from "../../component/table/produto/table";


const dominio = process.env.API_KEY;

export const PetContext = createContext();

async function fetchData(){
    const id = window.location.pathname.split("/").pop();
    
    try{
        const request = await fetch(dominio+`/StarPet/backend/products/pet?id=${id}`);
        const produto = await request.json();

        return produto;
    }catch(error){
        console.log(error)
    }
}

export function Pet({data}){
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
                    {produto.length !== 0 && <FichaPet data={produto[0]} />}
                </SectionOptionsPet>
                <Hr />  
              
               <InputMsg /> 

                <Hr />
                    
            </Main>
            <Footer />
       </PetContext.Provider>
    )
}



export const PetWithLoading = withLoadingAndFetch(Pet, fetchData);