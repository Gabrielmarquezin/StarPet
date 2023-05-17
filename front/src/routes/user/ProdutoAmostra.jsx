import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import { ProdutoRender } from "../../component/cards/produto/ProdutoCard";
import { ErrorData } from "../../component/error/EmptyDataError";
import { Footer } from "../../component/footer/footer";
import FilterProdutos from "../../component/menu/filter/FilterMenu";
import { Loading } from "../../styles/loading";
import { Article, Div, Location } from "../../styles/routes/produto/ProdutoStyle";

export const ProdutoContext = createContext();

export function ProdutoAmostra(){
    const [categoria, setCategoria] = useState('');
    const [type, setType] = useState('');

    const [loading, setLoading] = useState(true)
    const [produto, setProduto] = useState([]);

    const [erro, setErro] = useState(false);
    
    const path = useLocation();
    
    useEffect(()=>{
        const location = path.pathname.split("/");
        setCategoria(location[2])
        setType(location[3])
        fetchProduto(location[2], location[3]).then(data => {
          
          if(data.message == "empty products"){
            setErro(true)
            return;
          }
          setProduto(data)
          setErro(false)
          setLoading(false)
        })
      
    }, [path.pathname])

    async function fetchProduto(categoria, tipo){
      const dominio = process.env.API_KEY;
      try{
        const request = await fetch(dominio+`/StarPet/backend/products/categoria?name=${categoria}&tipo=${tipo}`)
        const response = await request.json()

        return response;
      }catch(error){
        console.log(error)
      }
    }
    
    return( 
      <>
        <Div>
          <Location>Starpet {'>'} {categoria} {'>'} {type}</Location>
        </Div>
        <Article>
            <ProdutoContext.Provider value={{data: produto}}>
              <FilterProdutos />
              {erro ? <ErrorData message={"Nenhum produto encontrado"} /> : <ProdutoRender isloading={loading}/>}
            </ProdutoContext.Provider>
        </Article>
        <Footer />
      </> 
    )
}
