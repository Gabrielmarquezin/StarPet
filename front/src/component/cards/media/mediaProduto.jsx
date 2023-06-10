import React, { useEffect } from "react";
import { useState } from "react";
import { StyleDash } from "../../../styles/card/produtoStyles/media";
import { P, Span } from "../../../styles/ui/uis";

export function MediaDashboard({quant, media}){
    const [status, setStatus] = useState("");

    useEffect(()=>{
        if(media > 1 && media < 2){
            setStatus("media")
        }else if(media >= 2){
            setStatus("alta")
        }else{
            setStatus("baixa")
        }
    }, [])

    return(
        <StyleDash status={status}>
            <P>Quantidade de produtos <br /> registrados:</P>
            <Span>{quant}</Span>
            <P>Sua latencia de produtos <br /> registrados: <strong>{status}</strong></P>
        </StyleDash>
    )
}