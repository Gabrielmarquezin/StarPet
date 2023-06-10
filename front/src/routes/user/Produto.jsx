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
import {ContainerSectionComentario } from "../../component/screens/produto/SectionComments";
import { Hr} from "../../styles/ui/uis";
import { InputMsg } from "../../component/screens/produto/Input";
import { FichaTecnica } from "../../component/table/produto/table";


const dominio = process.env.API_KEY;
const socket = new WebSocket("ws://localhost:3001/produto");

export const ProdutoContext = createContext();

async function fetchData(){
    const id = window.location.pathname.split("/").pop();
    
    try{
        const request = await fetch(dominio+`/StarPet/backend/products?id=${id}`);
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

                <SectionOptions>
                    {produto.length !== 0 && <FichaTecnica data={produto[0]}/>}
                </SectionOptions>
                <Hr />  
                
               <ContainerSectionComentario socket={socket}/>
               <InputMsg socket={socket}/> 
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

