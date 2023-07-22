import React from "react";
import { CardVendidos } from "../../component/cards/vendidos/vendidos";
import { StyleVendidos } from "../../styles/routes/produto/StyleProdutoVendido";
import { Select, Option} from "../../styles/ui/form";
import { Button, Div, Span } from "../../styles/ui/uis";
import { IoIosArrowBack } from "react-icons/io";
import { useRef } from "react";
import { useState } from "react";
import { createContext } from "react";
import { withLoading } from "../../HOC/withLoading";
import { useContext } from "react";
import { ErrorData } from "../../component/error/EmptyDataError";
import { useEffect } from "react";

const dominio = process.env.API_KEY;

// async function FetchData(){
//     try {
//         const request = await fetch(dominio+"/StarPet/backend/pedido_produto/find/categoria?categoria=cachorro")
//     } catch (error) {
        
//     }
// }

const PedidoContext = createContext();

function Cards(){
    const {data} = useContext(PedidoContext);

    return(
        <>
           {!data || data.message 
            ? <ErrorData message={"Nao tem produtos vendidos"} />
            : data.map(e => (
                    <CardVendidos
                        srcUser={"data:image/jpeg;base64,"+e.photo }
                        srcProduto={e.produto ? "data:image/jpeg;base64,"+e.produto.photo : "data:image/jpeg;base64,"+e.pet.photo}
                        email={e.email}
                        codProduto={e.produto ? e.produto.cod_produto : e.pet.cod_pet}
                        preco_total={e.produto ? e.produto.preco_total : e.pet.preco_total}
                        data={e.payment.data}
                        status={e.payment.status}
                        nomeProduto={e.produto ? e.produto.nome : e.pet.nome}
                        telefone={e.telefone}
                        categoria={e.produto ? e.produto.categoria : e.pet.categoria}
                        rua={e.rua}
                        bairro={e.bairro}
                        casa={e.casa_number}
                    />
                ))
            }
        </>
    )
}

const CardsWithLoading = withLoading(Cards);

export function Vendidos(){
    const container_vendidos = useRef();
    const categoria = useRef();
    const tipo = useRef();
    const search = useRef();

    const [loading, setLoading] = useState(false);
    const [pedido, setPedido] = useState([])
    const [currentHeight, setCurrentHeight] = useState(1242)

    useEffect(()=>{
        const btns = document.getElementById('btns');
        if(pedido.length == 0 || pedido.message){
            btns.style.display = "none";
        }else{
            btns.style.display = "flex";
        }
    }, [pedido])

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

    function getPedidos(){
        let $categoria_value = categoria.current.value;
        let $tipo_value = tipo.current.value;
        
        if($categoria_value == "todos"){
            setLoading(true)
            fetchAll($tipo_value)
            .then((data) => {
                setPedido(data);
                setLoading(false)
            })
            .catch(error => {
                setLoading(false)
            })
        }else{
            setLoading(true)
            findForCategoria($categoria_value, $tipo_value)
            .then((data) => {
                setPedido(data)
                setLoading(false)
            })
            .catch(error => {
                setLoading(false)
            })
        }

    }

    async function fetchAll(tipo){
        let link;

        if(tipo == "pet"){
            link = "/StarPet/backend/pedido_produto/pet/find"
        }else{
            link = "/StarPet/backend/pedido_produto/find"
        }

        try {
            const resquest = await fetch(dominio+link);
            const response = await resquest.json();

            return response;
        } catch (error) {
            console.log(error)
        }
    }


    async function findForCategoria(categoria, tipo){
        let link;
        if(tipo == "pet"){
            link = "/StarPet/backend/pedido_produto/pet/find"
        }else{
            link = "/StarPet/backend/pedido_produto/find"
        }

        try {
            const request = await fetch(dominio+link+`/categoria?categoria=${categoria}`)
            const response = await request.json();

            return response;
        } catch (error) {
            console.log(error)
        }
    }

    return(
       <StyleVendidos>
            <Div className="search">
                <Select placeholder="Categoria" ref={categoria}>
                    <Option value={"todos"}>todos</Option>
                    <Option value={"cachorro"}>Cachorro</Option>
                    <Option value={"gato"}>Gato</Option>
                    <Option value={"peixe"}>Peixe</Option>
                </Select>

                <Select placeholder="Categoria" ref={tipo}>
                    <Option value={"pet"}>Pet</Option>
                    <Option value={"produto"}>Produto/acessorios</Option>
                </Select>

                <Button type="button" onClick={getPedidos}>Pesquisar</Button>
            </Div>

           <PedidoContext.Provider value={{data: pedido}}>
                <Div className="containaer-pet" ref={container_vendidos}>
                    <Div className="pet-vendidos" id="vendidos">
                        <CardsWithLoading isloading={loading} />
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