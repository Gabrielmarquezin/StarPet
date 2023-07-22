import React, { useContext, useEffect, useState } from "react";
import { ContainerButton, ContainerContador, ContainerDescricao, ContainerImage, ContainerPay, ContainerPayment, ContainerValor, ProdutoName, SectionMainImage } from "../../../styles/routes/produto/ProdutoStyle";
import { Button, Image, Input, P, Span } from "../../../styles/ui/uis";
import { AiOutlinePlus, AiOutlineMinus} from 'react-icons/ai'; 
import {MdOutlinePix} from 'react-icons/md';
import Noimage from "../../../assets/noimage.png";
import { PetContext } from "../../../routes/user/Pet";
import { useNavigate } from "react-router-dom";
import { ProdutoContext as PaymentContext } from "../../../contexts/ProdutoContext";
import { useRef } from "react";
import { useAuth } from "../../../hook/useAuth";
import Swal from "sweetalert2";

export function SectionPet(){
    const {data} = useContext(PetContext)
    const {updateData} = useContext(PaymentContext);
    const [produto, setProduto] = useState({})
    const [fichatecnica, setFichatecnica] = useState({});

    useEffect(()=>{
       if(data.length !== 0){
            setProduto(data[0])
            updateData(data[0])
            setFichatecnica(data[0].ficha_pet)
       }
    }, [data])

   
    function ErrorPhoto(e){
        e.target.src = Noimage;
    }
    
    return(
        <SectionMainImage>
            <ContainerImage>
                <Image src={"data:image/jpeg;base64,"+produto.photo} alt="" onError={ErrorPhoto}/>
            </ContainerImage>

            <ContainerDescricao>
               <ProdutoName>
                    <P theme={{color: "#000000d6"}}>{produto.nome}</P>
               </ProdutoName>

               <ContainerPayment>
                    <P theme={{color: "#000000"}}>Meios de Pagamento</P>
                    <P theme={{color: "#000000a2"}}>Por enquanto aceitamos so via pix, para outros metodos de pagamento so via loja fisica</P>
                    <MdOutlinePix size={25} style={{color: "#00b0e8"}}/>
               </ContainerPayment>

               <Pay estoque={fichatecnica.estoque} 
                    adotado={produto.adotado} 
                    codProduto={produto.cod} 
                    type="adocao"
                />

            </ContainerDescricao>
        </SectionMainImage>
    )
}

function Pay({estoque, codProduto, type, adotado}){

    return(
        <ContainerPay>
            <P theme={{color: "#00000083"}}>Estoque: {estoque}</P>

            <ContainerValor>
                <ContainerContador>
                    <Span><AiOutlinePlus /></Span>
                    <Input type={"text"} value={"1"} readOnly/>
                    <Span><AiOutlineMinus /></Span>
                </ContainerContador>
            </ContainerValor>

            <Buttons quant={"1"} 
                     cod={codProduto} 
                     type={type}
                     adotado={adotado}
            />

        </ContainerPay>
    )
}



function Buttons({quant, cod, type, adotado}){
    const navigate = useNavigate();
    const {user} = useAuth();
    const btn = useRef();
    
    if(adotado == 1){
        btn.current.disabled = true;
    }

    async function handlePayment(){
        const cod_user = localStorage.getItem("cod_user");
         if(user == null || Object.keys(user) == 0){
              Swal.fire({
                 title: 'Você não esta logado',
                 text: "Para realizar uma compra você precisa estar logado",
                 icon: "error",
                 confirmButtonText: 'OK'
               })

               return;
         }

        navigate(`/produto/payment/adocao?codUser=${1}&codProduto=${cod}&quant=${quant}&type=${type}`)
    }

    return(
        <ContainerButton>
            <Button type={"button"} onClick={handlePayment} ref={btn}>ADOTAR</Button>
            <Button type={"button"} disabled>{adotado == 0 ? "NAO ADOTADO" : "JA FOI ADOTADO"}</Button>
        </ContainerButton>
    )
}