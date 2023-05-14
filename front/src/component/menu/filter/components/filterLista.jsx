import React from "react";
import { Section, Ul } from "../../../../styles/menu/MenuFilterStyles/filterProduto";
import { Li } from "../../../../styles/menu/menu_styles";
import { P } from "../../../../styles/ui/uis";

export function ListaFilter(){
    return(
        <Section>
            <P>Filtrar Produtos</P>
            <Ul>
                <Li>Limpar filtro</Li>
            </Ul>

            <P>Categorias</P>
            <Ul>
                <Li>Coleira</Li>
                <Li>Ração</Li>
                <Li>Brinquedos</Li>
                <Li>Cama</Li>
            </Ul>
        </Section>
    )
}