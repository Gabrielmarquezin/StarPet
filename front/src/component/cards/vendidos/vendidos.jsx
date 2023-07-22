import React, { useRef } from "react";
import { useState } from "react";
import { useReducer } from "react";
import { StyleCardVendido } from "../../../styles/card/produtoStyles/produtoStyleCard";
import { Div, Image, Span } from "../../../styles/ui/uis";

export function CardVendidos({srcUser, email, telefone, nomeProduto, categoria, preco_total, codProduto, rua, bairro, casa, data, status, srcProduto}){
    const [click, setClick] = useState(1)
    const container = useRef();

    function MaxWidht(){  
        if(click%2 == 0){
            container.current.style.maxHeight = "160px"; 
        }else{
            container.current.style.maxHeight = "688px";
        }
        setClick(click + 1)
    }

    return(
        <StyleCardVendido ref={container} onClick={MaxWidht}>
            <Div className="container-user">
                <Div className="user-informations">
                    <Span>{email}</Span>
                    <Span>{telefone}</Span>
                </Div>
                <Div className="img img-user">
                    <Image src={srcUser} />
                </Div>
            </Div>

            <Div className="container-card-produto">
                
                <Div className="img img-produto">
                    <Image src={srcProduto} />
                </Div>
                
                <Div className="payment-user">
                    <Div className="group">
                        <Span>Produto</Span>
                        <Div className="produto-information g">
                            <Span>Nome: {nomeProduto}</Span>
                            <Span>Categoria: {categoria}</Span>
                            <Span>Preço total: {preco_total}</Span>
                            <Span>Codigo: {codProduto}</Span>
                        </Div>
                    </Div>

                    <Div className="group">
                        <Span>ADRESS:</Span>
                        <Div className="address g">
                            <Span>Rua: {rua}</Span>
                            <Span>Bairro {bairro}</Span>
                            <Span>Casa: {casa}</Span>
                        </Div>
                    </Div>
                   
                   <Div className="group"> 
                        <Span>Payment</Span>
                        <Div className="payment g">
                            <Span>method: Pix</Span>
                            <Span>data: {data}</Span>
                            <Span>status: {status}</Span>
                        </Div>
                   </Div>
                </Div>
            </Div>
        </StyleCardVendido>
    )
}


export function CardVendidosBanho({srcUser, email, telefone, nomeProduto, kit, preco_total, horario, data, status, srcProduto, username, observacoes}){
    const [click, setClick] = useState(1)
    const container = useRef();

    function MaxWidht(){  
        if(click%2 == 0){
            container.current.style.maxHeight = "160px"; 
        }else{
            container.current.style.maxHeight = "688px";
        }
        setClick(click + 1)
    }

    return(
        <StyleCardVendido ref={container} onClick={MaxWidht}>
            <Div className="container-user">
                <Div className="user-informations">
                    <Span>{email}</Span>
                    <Span>{telefone}</Span>
                </Div>
                <Div className="img img-user">
                    <Image src={srcUser} />
                </Div>
            </Div>

            <Div className="container-card-produto">
                
                <Div className="img img-produto">
                    <Image src={srcProduto} />
                </Div>
                
                <Div className="payment-user">
                    <Div className="group">
                        <Span>Pet</Span>
                        <Div className="produto-information g">
                            <Span>Nome: {nomeProduto}</Span>
                            <Span>Observacoes: {observacoes}</Span>
                        </Div>
                    </Div>

                    <Div className="group">
                        <Span>Banho:</Span>
                        <Div className="address g">
                            <Span>kit: {kit}</Span>
                            <Span>preco {preco_total}</Span>
                            <Span>horario: {horario}</Span>
                        </Div>
                    </Div>
                   
                   <Div className="group"> 
                        <Span>Payment</Span>
                        <Div className="payment g">
                            <Span>method: Pix</Span>
                            <Span>data: {data}</Span>
                            <Span>status: {status}</Span>
                            <Span>Nome: {username}</Span>
                        </Div>
                   </Div>
                </Div>
            </Div>
        </StyleCardVendido>
    )
}