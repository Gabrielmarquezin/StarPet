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
        setCategoria(location[1])
        setType(location[3])

        fetchProduto(location[1], location[3]).then(data => {
          
          if(data.message == "empty products" || data.message == "nenhum pet registrado"){
            setErro(true)
            return;
          }
          setProduto(data)
          setErro(false)
          setLoading(false)
        })
      
    }, [path.pathname])

    async function fetchProduto(categoria, tipo){
      const location = path.pathname.split("/");
      const dominio = process.env.API_KEY;
      let link = dominio;

      if(location[2] == "produto"){
        link+=`/StarPet/backend/products/categoria?name=${categoria}&tipo=${tipo}`
      }
      if(location[2] == "pet"){
        link+=`/StarPet/backend/products/pet/categoria?nome=${categoria}`
      }
     
      try{
        const request = await fetch(link)
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
