import React, { useState } from "react";
import { useEffect } from "react";
import { MediaDashboard } from "../../component/cards/media/mediaProduto";
import { getProducts } from "../../functions/FetchProdutos";
import { P } from "../../styles/ui/uis";

export function QuantidadeProduto(){
    const [quant, setQuant] = useState(0);
    const [media, setMedia] = useState(0);

    useEffect(()=>{
        getAll().then(data => {
            const Datas = data.map(p => new Date(p.creat_at));
            const media_statics = parseFloat((quantDias(Datas) / data.length).toFixed(2))

            setMedia(media_statics)
            setQuant(data.length);
        })
    }, [])

    async function getAll(){
        try {
            const produto = await getProducts("produto");
            const pets = await getProducts("pet")

            
            return produto.concat(pets);
        } catch (error) {
            console.log(error)
        }
    }

    function quantDias(arrayDatas){
        const maiorData = arrayDatas.reduce((prev, current)=>{
            if(current.getTime() > prev.getTime()){
                return current
            }

            return prev
        })

        const menorData = arrayDatas.reduce((prev, current)=>{
            if(current.getTime() < prev.getTime()){
                return current
            }

            return prev
        })

        const diferença = maiorData - menorData;
        
        return diferença / (1000 * 60 * 60 * 24);
    }

    return(
       <MediaDashboard media={media} quant={quant} />
    )
}