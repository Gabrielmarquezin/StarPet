import React from "react";
import { createContext } from "react";
import { useCallback } from "react";
import { useEffect } from "react";
import { useContext } from "react";
import { useState } from "react";
import { useAsyncError } from "react-router-dom";
import { Carrossel } from "../../component/carrossel/carrossel";
import { ErrorData } from "../../component/error/EmptyDataError";
import { getProducts } from "../../functions/FetchProdutos";
import { withLoading } from "../../HOC/withLoading";
import { StylesProdutosCadastrados } from "../../styles/routes/home/HomeStylesAdm";
import { Div, P } from "../../styles/ui/uis";
import { Pet } from "../user/Pet";

const DataContext = createContext('');

const Produtos = ({data})=>{
  
    if(!data){
        return <ErrorData message={"Carregando..."} />
    }

    return(
        <StylesProdutosCadastrados>
            <Div className="produto-group">
                <P>Pets({data["pet"].length})</P>
                {data["pet"].length > 0 && 
                    <Carrossel img={data["pet"]} 
                        widthcarrossel="90%" 
                        heightcarrossel="172px" 
                        autoscroll={false}
                        sizebutton={25}
                        id={7}
                    />
                }
            </Div>

            <Div className="produto-group">
                <P>Gaiolas({data["gaiola"].length})</P>
                {data["gaiola"].length > 0 && 
                    <Carrossel img={data["gaiola"]} 
                        widthcarrossel="90%" 
                        heightcarrossel="172px" 
                        autoscroll={false}
                        sizebutton={25}
                        id={7}
                    />
                }
            </Div>

            <Div className="produto-group">
                <P>Ração({data["racao"].length})</P>
                {data["racao"].length > 0 && 
                    <Carrossel img={data["racao"]} 
                            widthcarrossel="90%" 
                            heightcarrossel="172px" 
                            autoscroll={false}
                            sizebutton={25}
                            id={7}
                    />
                }
            </Div>

            <Div className="produto-group">
                <P>Coleiras({data["coleira"].length})</P>
                {data["coleira"].length > 0 && 
                    <Carrossel img={data["coleira"]} 
                        widthcarrossel="90%" 
                        heightcarrossel="200px" 
                        autoscroll={false}
                        sizebutton={25}
                        id={7}
                    />
                }
            </Div>

            <Div className="produto-group">
                <P>Aquarios({data["aquario"].length})</P>
                {data["aquario"].length > 0 && 
                    <Carrossel img={data["aquario"]} 
                            widthcarrossel="100%" 
                            heightcarrossel="172px" 
                            autoscroll={false}
                            sizebutton={25}
                            id={7}
                    />
                }
            </Div>
            <P id="p" style={{color: "#8b8888"}}>AQUI ESTA APENAS ALGUNS PRODUTOS, SE VOÇẼ DESEJAR VER COM MAIS DETALHES, <br /> NAVEGUE EM PRODUTOS CADASTRADOS NO MENU VERTICAL NA LATERAL</P>
        </StylesProdutosCadastrados>
    )
}

const ProdutoWithLoading = withLoading(Produtos);

export function ProdutosCadastrados(){
    const [loading, setLoading] = useState(false)
    const [data, setData] = useState()

    useEffect(()=>{
       setLoading(true)
      
        getDatas().then(dados => {
            setData(dados)
            setLoading(false)
        })
    }, [])

   const getDatas = useCallback(async ()=>{
       let produtos = await getProducts("produto")
       let Pets = await getProducts("pet")

       if(Pets.message){
        Pets = []
       }else{
        Pets = Pets.map(pet => ({photo: "data:image/jpeg;base64,"+pet.photo, id: pet.cod}))
       }

       if(produtos.message){
         produtos = [];
       }

       if(produtos.message && Pets.message){
        return {Pets: Pets, Produtos: produtos}
       }


       const newData = produtos.reduce((accumulator, produto) => {
            if (produto.tipo === "coleira") {
                accumulator.coleira.push({photo: "data:image/jpeg;base64,"+produto.photo, id: produto.cod});
            } else if (produto.tipo === "racao") {
                accumulator.racao.push({photo: "data:image/jpeg;base64,"+produto.photo, id: produto.cod});
            } else if (produto.tipo === "gaiola") {
                accumulator.gaiola.push({photo: "data:image/jpeg;base64,"+produto.photo, id: produto.cod});
            } else if (produto.tipo === "aquario") {
                accumulator.aquario.push({photo: "data:image/jpeg;base64,"+produto.photo, id: produto.cod});
            }
            return accumulator;
        }, {
            coleira: [],
            racao: [],
            gaiola: [],
            aquario: []
        });

        return ({...newData, ["pet"]: Pets});
    }, [])

    return(
        <DataContext.Provider value={data}>
            <ProdutoWithLoading isloading={loading} data={data}/>
        </DataContext.Provider>
    )
}