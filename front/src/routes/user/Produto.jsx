import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useEffect } from "react";
import {Main, SectionCarrossel} from "../../styles/routes/produto/ProdutoStyle";
import Image from "../../assets/1.jpeg";
import { Footer } from "../../component/footer/footer";
import { Carrossel } from "../../component/carrossel/carrossel";
import { SectionOptions } from "../../component/screens/produto/sectionOptions";
import { SectionProduto } from "../../component/screens/produto/main";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import {SectionComentaios } from "../../component/screens/produto/SectionComments";
import { Hr} from "../../styles/ui/uis";


const dominio = process.env.API_KEY;
export const ProdutoContext = createContext();

async function fetchData(){
    const id = window.location.pathname.split("/");
    
    try{
        const request = await fetch(dominio+`/StarPet/backend/products?id=${id[4]}`);
        const produto = await request.json();

        return produto;
    }catch(error){
        console.log(error)
    }
}

export function Produto({data}){
    const [produto, setProduto] = useState([]);
    
    useEffect(()=>{
        setProduto(data)
    }, [])

    return (
       <ProdutoContext.Provider value={{data: produto}}>
            <Main>
                <SectionProduto />
                <Hr />

                <SectionOptions />
                <Hr />  
                
                <SectionComentaios />

                <Hr />
                <SectionCarrossel>
                    <Carrossel img={[Image, Image, Image, Image]} 
                               widthcarrossel="100%" 
                               heightcarrossel="200px" 
                               autoscroll={true}
                    /> 
                </SectionCarrossel>
            </Main>
            <Footer />
       </ProdutoContext.Provider>
    )
}



export const ProdutoWithLoading = withLoadingAndFetch(Produto, fetchData);

