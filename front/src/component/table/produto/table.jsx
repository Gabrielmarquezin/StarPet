import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { SubstituirValues } from "../../../functions/EmptyValues";
import { Table, Tbody, Td, Th, Tr } from "../../../styles/ui/table";

export function FichaTecnica({data}){
    const [ficha, setFicha] = useState({})

    useEffect(()=>{
        if(Object.entries(data).length !== 0){
            let f = Object.entries(data.ficha_tec)
            f = SubstituirValues(f, "---")

            setFicha(f)
        }
    }, [data])

    return(
        <Table>
           <Tbody>
                <Tr>
                    <Th scope="col" >Linha</Th>
                    <Th scope="col" >Modelo</Th>
                    <Th scope="col" >Marca</Th>
                    <Th scope="col" >Tamanho</Th>
                    <Th scope="col" >Cor</Th>
                    <Th scope="col" >Estoque</Th>
                </Tr>
                <Tr>
                    <Td>{ficha.linha}</Td>
                    <Td>{ficha.modelo}</Td>
                    <Td>{ficha.marca}</Td>
                    <Td>{ficha.tamanho}</Td>
                    <Td>{ficha.cor}</Td>
                    <Td>{ficha.estoque}</Td>
                </Tr>
           </Tbody>
        </Table>
    )
}