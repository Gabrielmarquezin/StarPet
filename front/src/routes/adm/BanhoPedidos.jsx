import React from "react";
import { CardVendidos, CardVendidosBanho } from "../../component/cards/vendidos/vendidos";
import { StyleVendidos } from "../../styles/routes/produto/StyleProdutoVendido";
import { Button, Div, Span } from "../../styles/ui/uis";
import { useRef } from "react";
import { useState } from "react";
import { withLoading } from "../../HOC/withLoading";
import { ErrorData } from "../../component/error/EmptyDataError";
import { useEffect } from "react";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";

const dominio = process.env.API_KEY;

async function fetchData(){
    try {
        const request = await fetch(dominio+"/StarPet/backend/pedido_produto/banho/get")
        const response = await request.json();

        console.log(response)
        return response;
    } catch (error) {
        console.log(error)
        return false;
    }
}


function BanhosVendidos({data}){
    console.log(data)
    const container_vendidos = useRef();
    const [currentHeight, setCurrentHeight] = useState(1242)

    useEffect(()=>{
        const btns = document.getElementById('btns');
        if(data){
            if(data.length == 0 || data.message){
                btns.style.display = "none";
            }else{
                btns.style.display = "flex";
            }
        }
    }, [data])

    function AumentarPage(){
        let HeightCards = document.getElementById("vendidos").clientHeight;
        let ContainerHeight = container_vendidos.current.clientHeight;

        if(HeightCards > ContainerHeight){
            container_vendidos.current.style.maxHeight = `${currentHeight + 1242}px`;
            setCurrentHeight(currentHeight + 1242)
        }
    }


    function DiminuirPage(){
        container_vendidos.current.style.maxHeight = "1242px";
    }

    return(
        <StyleVendidos>
            <Div className="containaer-pet" ref={container_vendidos}>
                <Div className="pet-vendidos" id="vendidos">
                    {!data || data.message 
                        ? <ErrorData message={"Nao tem produtos vendidos"} />
                        : data.map(e => (
                                <CardVendidosBanho
                                    srcUser={"data:image/jpeg;base64,"+e.photo_user}
                                    srcProduto={"https://s3.nuvemvet.com/blog/wp-content/uploads/2022/01/05114006/anuncio.png"}
                                    email={e.email}
                                    observacoes={e.pet.observacoes}
                                    preco_total={e.banho.preco}
                                    data={e.banho.data_pedido}
                                    status={e.payment.estado}
                                    nomeProduto={e.pet.nome}
                                    telefone={e.telefone}
                                    kit={e.banho.kit}
                                    username={e.username}
                                    horario={e.banho.horario}

                                />
                            ))
                     }
                </Div>
            </Div>
           
            <Div className="buttons" id="btns">
                <Button type="button" onClick={AumentarPage}>CARREGAR MAIS</Button>
                <Button type="button" onClick={DiminuirPage}>VOLTAR AO TOPO</Button>
            </Div>
       </StyleVendidos>
    )
}

export const BanhoVendidosWithLoading = withLoadingAndFetch(BanhosVendidos, fetchData);