import React from "react";
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button, Div, Image, P } from "../../../styles/ui/uis";
import { Loading2Version } from "../loading/loading";


export function Pix({src}){
    const [loading, setLoading] = useState(true)
    const navigate = useNavigate();

    function handleLoad(){
        setLoading(false)
    }

    function goBack(){
       navigate(-1)
    }

    return(
        <Div className="container-pix">
            <Div className="info-1">
                <P>Ola claro cliente, ao escanear o pix você recebera um email informando a confirmaçao de seu pagamento, apos isso voçẽ ja pode sair dessa pagina</P>
            </Div>
            <Div className="imagem-pix">
                {loading && <Loading2Version />}
                <Image src={"data:image/jpeg;base64,"+src} onLoad={handleLoad}/>
            </Div>
            <Div className="info-2">
                <P>por enquanto aceitamaos somente pix, em breve receberemos outros meios de pagamento.</P>
            </Div>
            <Div className="btn">
                <Button type="button" onClick={goBack}>Voltar ao inicio</Button>
            </Div>
        </Div>
    )
}