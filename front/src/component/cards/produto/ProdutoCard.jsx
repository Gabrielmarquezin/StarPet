import React from "react";
import { Section } from "../../../styles/card/produtoStyles/produtoStyleCard";
import { CardProduto } from "./components/card";
import logo from "../../../assets/starpet.png"
import { useContext } from "react";
import { ProdutoContext } from "../../../routes/user/ProdutoAmostra";
import { useEffect } from "react";
import { withLoading } from "../../../HOC/withLoading";


function Produto({setLoading}){
    const {data} = useContext(ProdutoContext);
    
    return(
        <Section>
           {data.map(p => (
               <CardProduto src={p.photo == "" ? NoImage : p.photo} 
                            nome={p.nome} 
                            preco={p.preco} 
                            id={p.cod} 
                            key={p.cod}
                />
           ))}
        </Section>
    )
}


export const ProdutoRender = withLoading(Produto)