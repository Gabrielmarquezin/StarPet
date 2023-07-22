import React from "react";
import { useEffect } from "react";
import { useState } from "react";
import { useLocation } from "react-router-dom";
import { ProdutoRender } from "../../component/cards/produto/ProdutoCard";
import { ErrorData } from "../../component/error/EmptyDataError";
import { Footer } from "../../component/footer/footer";
import { FilterSearchProdutos } from "../../component/menu/filter/FilterMenu";
import { FooterP } from "../../styles/footer/footer";
import { Article } from "../../styles/routes/produto/ProdutoStyle";
import { Main } from "../../styles/routes/produto/stylesSearchProduto";
import { ProdutoContext } from "./ProdutoAmostra";

const dominio = process.env.API_KEY;



export function SearchProdutos(){
    const [loading, setLoading] = useState(true);
    const [data, setData] = useState([]);
    const [empty, setEmpty] = useState(false)

    const location = useLocation();
    const params = new URLSearchParams(location.search);
    const name = params.get("name")

    useEffect(()=>{
        setEmpty(false)

        if(name == ""){
            setEmpty(true)
            return;
        }
        
        getProdutos(name)
        .then(produtos => {
            if(produtos.message){
                setEmpty(true)
                return;
            }
            setData(produtos)
            setLoading(false)
        })
        .catch(error => {
            setEmpty(true)
        })
    }, [location.search])

    async function getProdutos(value){
        try {
            const request = await fetch(dominio+`/StarPet/backend/products/find?search=${value}`);
            const response = await request.json();

            return response;
        } catch (error) {
            console.log(error)
        }
    }

    return (
       <ProdutoContext.Provider value={{data: data}}>
            <Article style={{marginTop: "50px"}}>
                <FilterSearchProdutos />
                {empty
                    ? <ErrorData message={"Nenhum produto encontrado"} /> 
                    : <ProdutoRender isloading={loading} />
                }
            </Article>
            <Footer />
       </ProdutoContext.Provider>
    )
}