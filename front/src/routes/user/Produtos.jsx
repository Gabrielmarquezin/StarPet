import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import { Produto } from "../../component/cards/produto/ProdutoCard";
import { Footer } from "../../component/footer/footer";
import FilterProdutos from "../../component/menu/filter/FilterMenu";
import { Loading } from "../../styles/loading";
import { Article, Div, Location } from "../../styles/routes/produto/ProdutoStyle";


export function Produtos(){
    const [categoria, setCategoria] = useState('');
    const [loading, setLoading] = useState(true)

    const [type, setType] = useState('');
    const path = useLocation();
    
    useEffect(()=>{
        const location = path.pathname.split("/");
        setCategoria(location[2])
        setType(location[3])
        
        fetchProduto(path[2], path[3]).then(data => {
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
            <FilterProdutos />
            {loading ? <Loading /> : <Produto />}
        </Article>
        <Footer />
      </> 
    )
}
