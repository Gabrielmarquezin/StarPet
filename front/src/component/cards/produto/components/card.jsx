import React from "react";
import { ContainerCardProduto, ContainerImageProduto, ContainerInfoProduto, P } from "../../../../styles/card/produtoStyles/produtoStyleCard";
import { Image,Span } from "../../../../styles/ui/uis";
import { theme } from "../../../../styles/GlobalStyles";

export function CardProduto({src, nome, preco}){

    function handleImage(){
        console.log("imagem carregou")
    }

    return(
       <ContainerCardProduto>
            <ContainerImageProduto>
                <Image src={src} alt={"imagem produto"} onLoad={handleImage}/>
            </ContainerImageProduto>

            <ContainerInfoProduto>
                <Span size={"1.5rem"} color="#000">{preco}</Span>
                <P>{nome}</P>
            </ContainerInfoProduto>
       </ContainerCardProduto>
    )
}