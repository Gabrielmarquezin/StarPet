import React from "react";
import { createContext } from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import { ProdutoRender } from "../../component/cards/produto/ProdutoCard";
import { ErrorData } from "../../component/error/EmptyDataError";
import { Footer } from "../../component/footer/footer";
import { FilterPeixeMenu } from "../../component/menu/filter/FilterPeixesMenu";
import { Loading } from "../../styles/loading";
import { Article, Div, Location } from "../../styles/routes/produto/ProdutoStyle";
import { ProdutoContext } from "./ProdutoAmostra";

const dominio = process.env.API_KEY;

export function PetPeixeAmostra(){
    const [type, setType] = useState('');
    const [loading, setLoading] = useState(true)
    const [produto, setProduto] = useState([]);

    const [erro, setErro] = useState(false);
    
    const path = useLocation();
    
    useEffect(()=>{
        const location = path.pathname.split("/");

        setType(location[3])

        if(location[3] == "todos"){
          fetchProduto("peixe").then(data => {
            if(data.message == "empty products" || data.message == "nenhum pet registrado"){
              setErro(true)
              return;
            }
            setProduto(data)
          })
        }else{
          FilterPeixes(location[3]).then(data => {
            if(data.message == "nenhum pet registrado" || data.length == 0){
              setErro(true)
              return;
            }
            
            setProduto(data)
          })
         
        }
          
          setErro(false)
          setLoading(false)    
    }, [path.pathname])

    async function fetchProduto(categoria){
      try{
        const request = await fetch(dominio+`/StarPet/backend/products/pet/categoria?nome=${categoria}`)
        const response = await request.json()

        return response;
      }catch(error){
        console.log(error)
      }
    }

    async function FilterPeixes(raca){
      const peixes = await fetchProduto("peixe")
      const PeixeFilter = peixes.filter(f => (f.ficha_pet.raca == raca))

      return PeixeFilter;
    }
    
    return( 
      <>
        <Div>
          <Location>Starpet {'>'} {"pet"} {'>'} {type}</Location>
        </Div>
        <Article>
            <ProdutoContext.Provider value={{data: produto}}>
              <FilterPeixeMenu />
              {erro ? <ErrorData message={"Nenhum produto encontrado"} /> : <ProdutoRender isloading={loading}/>}
            </ProdutoContext.Provider>
        </Article>
        <Footer />
      </> 
    )
}
