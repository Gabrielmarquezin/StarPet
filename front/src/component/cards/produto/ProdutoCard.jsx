import React from "react";
import { Section } from "../../../styles/card/produtoStyles/produtoStyleCard";
import { CardProduto } from "./components/card";
import NoImage from "../../../assets/noimage.png"
import { useContext } from "react";
import { ProdutoContext } from "../../../routes/user/ProdutoAmostra";
import { withLoading } from "../../../HOC/withLoading";
import { useEffect } from "react";


function Produto({setLoading}){
    const {data} = useContext(ProdutoContext);
    
    return(
        <Section>
           {data.map((p, i) => (
               <CardProduto src={p.photo == "" ? NoImage : "data:image/jpeg;base64,"+p.photo} 
                            nome={p.nome} 
                            preco={"R$"+p.preco} 
                            id={p.cod} 
                            type={p.ficha_pet ? "pet" : "produto"}
                            descricao={p.descricao}
                            key={i}
                />
           ))}
        </Section>
    )
}


export const ProdutoRender = withLoading(Produto)