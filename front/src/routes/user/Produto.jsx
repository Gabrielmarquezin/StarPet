import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useContext } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import { withLoading } from "../../HOC/withLoading";
import { ContainerContador, ContainerDescricao, ContainerImage, ContainerPay, ContainerPayment, ContainerValor, Main, ProdutoName, SectionMainImage } from "../../styles/routes/produto/ProdutoStyle";
import { Button, Image, Input, P, Span } from "../../styles/ui/uis";
import Noimage from "../../assets/noimage.png";
import { Footer } from "../../component/footer/footer";

import { AiOutlinePlus } from 'react-icons/ai';
import {AiOutlineMinus} from 'react-icons/ai';  
import {MdOutlinePix} from 'react-icons/md';

const dominio = process.env.API_KEY;
const ProdutoContext = createContext();

function SectionProduto({setLoading}){
    const {data} = useContext(ProdutoContext)
    const [produto, setProduto] = useState({})
    const [fichatecnica, setFichatecnica] = useState({});

    const [cont, setCont] = useState(1)

    useEffect(()=>{
       if(data.length !== 0){
            setProduto(data[0])
            setFichatecnica(data[0].ficha_tec)
       }
    }, [data])

    useEffect(()=>{
        if(cont < 1){
            setCont(1)
        }

        if(cont >= fichatecnica.estoque){
            setCont(5)
        }
    }, [cont])

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

               <ContainerPay>
                    <P theme={{color: "#00000083"}}>Estoque: {fichatecnica.estoque}</P>
                    <ContainerValor>
                        <ContainerContador>
                            <Span onClick={()=>setCont(cont + 1)}><AiOutlinePlus /></Span>
                            <Input type={"text"} value={cont} readOnly/>
                            <Span onClick={()=>setCont(cont-1)}><AiOutlineMinus /></Span>
                        </ContainerContador>
                        <P theme={{color: "#000000b7"}}>Valor total: R${produto.preco * cont}</P>
                    </ContainerValor>
                    <Button type={"button"}>COMPRAR</Button>
               </ContainerPay>
            </ContainerDescricao>
        </SectionMainImage>
    )
}

const SectionWithLoading = withLoading(SectionProduto)

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
            setLoading(false)
        })
    }, [])

    return (
       <ProdutoContext.Provider value={{data: produto}}>
            <Main>
                {produto.length !== 0 && <SectionWithLoading isloading={loading} />}
            </Main>
            <Footer />
       </ProdutoContext.Provider>
    )
}

