import React from "react";
import { useRef } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { ContainerCardProduto, ContainerImageProduto, ContainerInfoProduto, P } from "../../../../styles/card/produtoStyles/produtoStyleCard";
import { Div, Image,Span } from "../../../../styles/ui/uis";
import NoImage from "../../../../assets/noimage.png"

export function CardProduto({src, nome, preco, id, date}){
    const Navigate = useNavigate();
    const path = useLocation();
    const img = useRef('');

    function handleProduto(){
        const location = path.pathname;

        Navigate(location+`/${id}`)
    }
    function ErrorPhoto(){
        
        img.current.src = NoImage;
    }
    return(
       <ContainerCardProduto onClick={handleProduto}>
            <ContainerImageProduto>
                <Image src={src} alt={"imagem produto"} onError={ErrorPhoto} ref={img}/>
            </ContainerImageProduto>

            <ContainerInfoProduto>
                <Span size={"1.5rem"} color="#000">
                    {preco}
                    <P>{date}</P>
                </Span>
                <Div className="ui-preco-cod-group">
                    <P>{nome}</P>
                    <P>{"cod: "+id}</P>
                </Div>
            </ContainerInfoProduto>
       </ContainerCardProduto>
    )
}