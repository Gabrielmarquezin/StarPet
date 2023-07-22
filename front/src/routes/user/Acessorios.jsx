import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import { ProdutoRender } from "../../component/cards/produto/ProdutoCard";
import { ErrorData } from "../../component/error/EmptyDataError";
import { Footer } from "../../component/footer/footer";
import { FilterPassaro } from "../../component/menu/filter/FilterPassaro";
import { Article, Div, Location } from "../../styles/routes/produto/ProdutoStyle";
import { ProdutoContext } from "./ProdutoAmostra";

const dominio = process.env.API_KEY;

export function PassarosAcessorios(){
    const [type, setType] = useState('argorlas');
    const [loading, setLoading] = useState(true)
    const [produto, setProduto] = useState([]);

    const [erro, setErro] = useState(false);
    
    const path = useLocation();
    
    useEffect(()=>{
        const location = path.pathname.split("/");

        setType(location[3])

        fetchProduto("passaro", location[3]).then(data => {
            if(data.message == "empty products" || data.message == "nenhum pet registrado"){
              setErro(true)
              return;
            }
            setProduto(data)
          })
      
          setErro(false)
          setLoading(false)    
    }, [path.pathname])

    async function fetchProduto(categoria, type){
      try{
        const request = await fetch(dominio+`/StarPet/backend/products/categoria?name=${categoria}&tipo=${type}`)
        const response = await request.json()

        return response;
      }catch(error){
        console.log(error)
      }
    }
    
    return( 
      <>
        <Div>
          <Location>Starpet {'>'} {"pet"} {'>'} {type}</Location>
        </Div>
        <Article>
            <ProdutoContext.Provider value={{data: produto}}>
              <FilterPassaro />
              {erro ? <ErrorData message={"Nenhum produto encontrado"} /> : <ProdutoRender isloading={loading}/>}
            </ProdutoContext.Provider>
        </Article>
        <Footer />
      </> 
    )
}