import { async } from "@firebase/util";
import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useContext } from "react";
import { useLocation } from "react-router-dom";
import { Footer } from "../../component/footer/footer";
import { PaymentForm } from "../../component/form/payment/form";
import { Pix } from "../../component/screens/payment/pix";
import { ProdutoContext } from "../../contexts/ProdutoContext";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import { StylePaymentForm } from "../../styles/form/StylePayment";
import { Div, Image, P, Span } from "../../styles/ui/uis";

const dominio = process.env.API_KEY;

async function fetchData(){
    const params = new URLSearchParams(window.location.search);
    const cod = params.get("codProduto");

    let type = params.get("type")
    let link;
    
    switch(type){
        case "produto":
            link = `/StarPet/backend/products?id=${cod}`;
            break;
        case "pet":
            link = `/StarPet/backend/products/pet?id=${cod}`;
            break;

        default:
            link = "";
            break;
    }

    try {
        const request = await fetch(dominio+link);
        const response = await request.json();

        return response[0];
    } catch (error) {
        console.log(error)
    }
}

function Produto({data}){
   
    const {photo, descricao, preco} = data;
    
    const location = useLocation();
    const params = new URLSearchParams(location.search);
    const quant = params.get("quant")
    
    return(
        <Div className="ui-container-produto-payment">
            <Div className="produto">
                <Div className="img-produto-payment" style={{overflow: "hidden"}}>
                    <Image src={"data:image/jpeg;base64,"+photo} />
                </Div>
                <Div className="desc">
                    <Span>Descrição</Span>
                    <P>{descricao}</P>
                </Div>
            </Div>
            <Div className="info">
                <Span>Quantidade: {quant}</Span>
                <Span>Total a pagar: R${quant * preco}</Span>
            </Div>
        </Div>
    )
}
export const PaymentContext = createContext('')

export function Payment({data}){
    const [payment, setPayment] = useState({qr_cod: "", id_pedido: "", Produto: data})

    return(
         <PaymentContext.Provider value={{payment, setPayment}}>
            <StylePaymentForm>
                 <Div className="container-all">
                     <Div className="container-payment">
                        <Produto data={data}/>
                        <PaymentForm />
                     </Div>
                     <Pix src={payment.qr_cod}/>
                 </Div>
             </StylePaymentForm>
             <Footer />
         </PaymentContext.Provider>
         
    )
}


export const PaymentWihtLoading = withLoadingAndFetch(Payment, fetchData)
