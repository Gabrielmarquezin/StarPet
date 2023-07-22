import React from "react";
import { StyleCardProduto } from "../../../styles/card/produtoStyles/StyleProdutoSaved";
import { Div, Image, Input, P, Span } from "../../../styles/ui/uis";
import Noimage from "../../../assets/noimage.png"
import { Loading2Version } from "../../screens/loading/loading";
import { useState } from "react";
import { useNavigate } from "react-router-dom";

export function CardProduto({src, nome, descricao, quantidade, preco, navigation, type, cod}){

    const [loading, setLoading] = useState(true);
    const navigate = useNavigate();

    function Error(e){
        e.target.src = Noimage;
    }

    function LoadImg(){
        setLoading(false)
    }

    function Navigation(){
        if(!navigation){
            return;
        }

        navigate(`${type}/${cod}`)
    }
    return(
        <StyleCardProduto>
            <Div className="ui-container-produto-saved" onClick={Navigation}>
                <Div className="container-img">
                    {loading && <Loading2Version />}
                    <Image src={src} alt="loading" id="img-produto-saved" onError={Error} onLoad={LoadImg} />
                </Div>
                <Div className="container-infor">
                    <P>{nome}</P>
                    <P>{descricao}</P>
                </Div>
                <Div className="container-financas">
                    <Div className="input-group">
                        <Span>Quantidade</Span>
                        <Input type={"text"} id="quant" value={quantidade} disabled />
                    </Div>
                    <Div className="input-group">
                        <Span>Preço</Span>
                        <Input type={"text"} id="quant" value={"R$ "+preco * quantidade || ""} disabled />
                    </Div>
                </Div>
            </Div>
        </StyleCardProduto>
    )
}