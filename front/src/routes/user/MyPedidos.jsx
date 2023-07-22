import React from "react";
import { useRef } from "react";
import { useEffect } from "react";
import { useContext } from "react";
import { createContext } from "react";
import { useState } from "react";
import Swal from "sweetalert2";
import { CardProduto } from "../../component/cards/favorite/favorite";
import { ErrorData } from "../../component/error/EmptyDataError";
import { withLoading } from "../../HOC/withLoading";
import { withLoadingAndFetch } from "../../HOC/withLoadingAndFetch";
import { Section } from "../../styles/routes/produto/StyleProdutoSaved";
import { StyleVendidos } from "../../styles/routes/produto/StyleProdutoVendido";
import { Option, Select } from "../../styles/ui/form";
import { Button, Div, Hr, P } from "../../styles/ui/uis";


const dominio = process.env.API_KEY
const PedidoContext = createContext();


function CardsPedidos(){
    const {data} = useContext(PedidoContext)

    if(!data || data.length == 0 || data.message){
        return <ErrorData message={"Nenhum pedido realizado"} />
    }

    return(
        <>
            {data.length > 0 
                    && data.map((d, i) => {
                      // Verifica se há a propriedade "pet", caso contrário, usa "produto"
                        return (
                          <CardProduto
                            src={"data:image/jpeg;base64," + (d.pet ? d.pet.photo : d.produto.photo)}
                            quantidade={d.pet ? (d.pet.preco_total / d.pet.preco_unit) : (d.produto.preco_total / d.produto.preco_unit)}
                            nome={d.pet ? d.pet.nome : d.produto.nome}
                            preco={d.pet ? d.pet.preco_total : d.produto.preco_total}
                            descricao={d.pet ? d.descricao : d.produto.descricao}
                            navigation={true}
                            type={"produto"}
                            cod={d.pet ? d.pet.cod_pet : d.produto.cod_produto}
                            key={i}
                          />
                        );
                })}
        </>
    )
}


const CardsPedidosWithLoading = withLoading(CardsPedidos)

export function MyPedidos(){
    const [loading, setLoading] = useState(false)
    const [pedido, setPedido] = useState([])
    const [currentHeight, setCurrentHeight] = useState(620)

    const type = useRef();
    const container_vendidos = useRef()
    const codUser = localStorage.getItem("cod_user")

    useEffect(()=>{
        if(pedido.length == 0 || pedido.message){
            const btns = document.getElementById("btns")
            btns.style.display = "none";
        }else{
            const btns = document.getElementById("btns")
            btns.style.display = "flex";
        }
    }, [pedido])

    async function getPedidos(){
        let link;
        let type_fetch = type.current.value;

        switch(type_fetch){
            case "pet":
                link = `/StarPet/backend/pedido_produto/pet/find?user=${codUser}`
            break;

            case "produto":
                link = `/StarPet/backend/pedido_produto/find?user=${codUser}`
            break;
        }

        try {
            setLoading(true)
            const request = await fetch(dominio+link)
            const response = await request.json()
            setPedido(response)
            setLoading(false)

            console.log(response)
            return response
        } catch (error) {
            console.log(error)
            setLoading(false);
            Swal.fire({
                title: "Ops!, houve um erro",
                text: "erro no servidor",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    }

    function AumentarPage(){
        let HeightCards = document.getElementById("vendidos").clientHeight;
        let ContainerHeight = container_vendidos.current.clientHeight;

        if(HeightCards > ContainerHeight){
            container_vendidos.current.style.maxHeight = `${currentHeight + 620}px`;
            setCurrentHeight(currentHeight + 620)
        }
    }

    function DiminuirPage(){
        container_vendidos.current.style.maxHeight = "650px";
    }

    return(
        <StyleVendidos style={{width: "100%", padding: "30px", position: "relative"}}>
            <P style={{fontSize: "1.5rem"}}>MEUS PEDIDOS</P>
            <Hr />
            <br />
            <Div className="search">
                <Select ref={type} >
                    <Option value={"pet"}>Pet</Option>
                    <Option value={"produto"}>Produtos</Option>
                </Select>

                <Button type="button" onClick={getPedidos}>Pesquisar</Button>
            </Div>

           <PedidoContext.Provider value={{data: pedido}}>
                <Div className="containaer-pet" ref={container_vendidos} style={{ maxHeight: "620px", transition: "max-height 0.5s ease-in-out"}}>
                    <Div className="pet-vendidos" id="vendidos" style={{padding: "20px"}}>
                        <CardsPedidosWithLoading isloading={loading} />
                    </Div>
                </Div>
           </PedidoContext.Provider>

            <Div className="buttons" id="btns">
                <Button type="button" onClick={AumentarPage}>CARREGAR MAIS</Button>
                <Button type="button" onClick={DiminuirPage}>VOLTAR AO TOPO</Button>
            </Div>
       </StyleVendidos>
    )
}
