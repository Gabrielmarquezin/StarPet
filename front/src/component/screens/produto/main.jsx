import React, { useContext, useEffect, useState} from "react";
import { ContainerButton, ContainerContador, ContainerDescricao, ContainerImage, ContainerPay, ContainerPayment, ContainerValor, ProdutoName, SectionMainImage } from "../../../styles/routes/produto/ProdutoStyle";
import { Button, Image, Input, P, Span } from "../../../styles/ui/uis";
import { AiOutlinePlus, AiOutlineHeart, AiOutlineMinus, AiFillHeart} from 'react-icons/ai'; 
import {MdOutlinePix} from 'react-icons/md';
import Noimage from "../../../assets/noimage.png";
import { ProdutoContext } from "../../../routes/user/Produto";
import { PetContext } from "../../../routes/user/Pet";
import Swal from "sweetalert2";
import { useNavigate } from "react-router-dom";
import { ProdutoContext as PaymentContext } from "../../../contexts/ProdutoContext";
import { useAuth } from "../../../hook/useAuth";

export function SectionProduto(){
    const {data} = useContext(ProdutoContext)
    const {updateData} = useContext(PaymentContext);
    const [produto, setProduto] = useState({})
    const [fichatecnica, setFichatecnica] = useState({});

    useEffect(()=>{
       if(data.length !== 0){
            setProduto(data[0])
            updateData(data[0])
            setFichatecnica(data[0].ficha_tec)
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

               <Pay estoque={fichatecnica.estoque} produto={produto} codProduto={produto.cod} type={"produto"} preco={produto.preco} /> 
            </ContainerDescricao>
        </SectionMainImage>
    )
}

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

               <Pay estoque={fichatecnica.estoque} preco={produto.preco} codProduto={produto.cod} type="pet"/>
            </ContainerDescricao>
        </SectionMainImage>
    )
}

function Pay({estoque, preco, codProduto, type}){
    const [cont, setCont] = useState(1)
    const [fillHeart, setFillheart] = useState(false)
    const [click, setClick] = useState(0)

    const {user} = useAuth()

    useEffect(()=>{
        if(cont < 1){
            setCont(1)
        }
        if(cont >= estoque){
            setCont(5)
        }
    }, [cont])

    useEffect(()=>{
        if(user !== null && Object.keys(user).length !== 0){
            if(codProduto){
                const favorites = JSON.parse(localStorage.getItem("favorites"));
                const obj = {
                    type: type,
                    cod: codProduto
                }
                const isObject = objetoEstaNoArray(obj, favorites)
    
                if(click == 0){
                    if(isObject){
                        setFillheart(true)
                    }
                }else{
                    if(fillHeart){
                        favorites.push(obj)
                        localStorage.setItem("favorites", JSON.stringify(favorites));
                    }else{
                        favorites.pop();
                        localStorage.setItem("favorites", JSON.stringify(favorites));
                    }
                }
            }
    
        }
    }, [fillHeart, codProduto])

    function changeHeart(){
        if(!user){
            Swal.fire({
                title: "Você não esta logado",
                text: "por favor faça seu login",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }
        setClick(click + 1)
        setFillheart((value) => !value)
    }

    function objetoEstaNoArray(objeto, array){
        for (let i = 0; i < array.length; i++) {
            if (array[i].type == objeto.type & array[i].cod == objeto.cod) {
                return true;
            }
          }
          return false;
    }

    return(
        <ContainerPay>
            <P theme={{color: "#00000083"}}>Estoque: {estoque}</P>

            <ContainerValor>
                <ContainerContador>
                    <Span onClick={()=>setCont(cont + 1)}><AiOutlinePlus /></Span>
                    <Input type={"text"} value={cont} readOnly/>
                    <Span onClick={()=>setCont(cont-1)}><AiOutlineMinus /></Span>
                </ContainerContador>

                <P theme={{color: "#000000b7"}}>Valor total: R${parseFloat((preco * cont).toFixed(2))}</P>
                {fillHeart 
                    ? <AiFillHeart size={30}  onClick={changeHeart} style={{cursor: "pointer", color: "red"}} />
                    : <AiOutlineHeart size={30} onClick={changeHeart} style={{cursor: "pointer"}}/>
                }
            </ContainerValor>

            <Buttons quant={cont} cod={codProduto} type={type}/>
        </ContainerPay>
    )
}



function Buttons({quant, cod, type}){
    const navigate = useNavigate();
    const {user} = useAuth();
    const [text, setText] = useState("ADICIONAR NO CARRINHO")
    const [click, setClick] = useState(0)

    async function handlePayment(){
        const cod_user = localStorage.getItem("cod_user");
         if(!cod_user || cod_user == "" || !user){
              Swal.fire({
                 title: 'Você não esta logado',
                 text: "Para realizar uma compra você precisa estar logado",
                 icon: "error",
                 confirmButtonText: 'OK'
               })

               return;
         }

        navigate(`/produto/payment?codUser=${cod_user}&codProduto=${cod}&quant=${quant}&type=${type}`)
    }

    useEffect(()=>{
        if(user !== null && Object.keys(user).length !== 0){
            if(cod){
                const carrinho = JSON.parse(localStorage.getItem("carrinho"));
                const obj = {
                    type: type,
                    cod: cod
                }
                const isObject = objetoEstaNoArray(obj, carrinho)
    
                if(isObject){
                    setText("REMOVER DO CARRINHO")
                }
            }
        }
    }, [cod])

    function addCarrinho(){
        if(user == null || Object.keys(user).length == 0){
            Swal.fire({
                title: "Você não esta logado",
                text: "por favor faça seu login",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }

        if(cod){
            const carrinho = JSON.parse(localStorage.getItem("carrinho"));
            const obj = {
                type: type,
                cod: cod
            }
            const isObject = objetoEstaNoArray(obj, carrinho)

            if(click == 0){
                if(isObject){
                    carrinho.pop()
                    localStorage.setItem("carrinho", JSON.stringify(carrinho));
                    setText("ADICIONAR NO CARRINHO")
                }
            }else{
                if(click%2 == 0){
                    carrinho.pop()
                    localStorage.setItem("carrinho", JSON.stringify(carrinho));
                    setText("ADICIONAR NO CARRINHO")
                }else{
                    if(click%2 !== 0){
                        carrinho.push(obj)
                        localStorage.setItem("carrinho", JSON.stringify(carrinho));
                        setText("REMOVER DO CARRINHO")
                    }
                }
            }

            setClick(click + 1)
        }
    }

    function objetoEstaNoArray(objeto, array){
        for (let i = 0; i < array.length; i++) {
            if (array[i].type == objeto.type & array[i].cod == objeto.cod) {
                return true;
            }
          }
          return false;
    }

    return(
        <ContainerButton>
            <Button type={"button"} onClick={handlePayment} >COMPRAR</Button>
            <Button type={"button"} onClick={addCarrinho}>{text}</Button>
        </ContainerButton>
    )
}

