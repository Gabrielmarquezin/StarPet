import React from "react";
import { Div, Input, Span } from "../../../../styles/ui/uis";

export function FichaPet(){
    return(
        <>
            <Div className="input-group">
                <Input type={"text"} name={"raca"} placeholder="raça" />
            </Div>
    
            <Div className="input-group">
                <Input type={"text"} name={"alergias"} placeholder="alergias" />
            </Div>

            <Div className="input-group">
                <Input type={"text"} name={"observacoes"} placeholder="observações" />
            </Div>

            <Div className="input-group">
                <Input type={"text"} name={"tamanho"} placeholder="tamanho" />
            </Div>

            <Div className="input-group">
                <Input type={"text"} name={"estoque"} placeholder="estoque" required/>
            </Div>
        </>
    )
}