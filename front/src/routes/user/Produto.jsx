import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import {Main, SectionCarrossel} from "../../styles/routes/produto/ProdutoStyle";
import Image from "../../assets/1.jpeg";
import { Footer } from "../../component/footer/footer";
import { SectionWithLoading } from "../../component/screens/produto/main";
import { Carrossel } from "../../component/carrossel/carrossel";

const dominio = process.env.API_KEY;

export const ProdutoContext = createContext();
export function Produto(){
    const path = useLocation();
    const [loading, setLoading] = useState(false)
    const [produto, setProduto] = useState([]);

    async function fetchData(id){
        try{
            const request = await fetch(dominio+`/StarPet/backend/products?id=${id}`);
            const produto = await request.json();

            return produto;
        }catch(error){
            console.log(error)
        }
    }
    useEffect(()=>{
        const id = path.pathname.split("/");
        
        setLoading(true)
        fetchData(id[4]).then(data => {
            setProduto(data)
            console.log(data)
            setLoading(false)
        })
    }, [])

    return (
       <ProdutoContext.Provider value={{data: produto}}>
            <Main>
                {produto.length !== 0 && <SectionWithLoading isloading={loading} />}
                <SectionCarrossel>
                    <Carrossel img={[Image, Image, Image, Image]} 
                            widthcarrossel="70%" 
                            heightcarrossel="200px" 
                            autoscroll={true}
                    /> 
                </SectionCarrossel>
            </Main>
            <Footer />
       </ProdutoContext.Provider>
    )
}

