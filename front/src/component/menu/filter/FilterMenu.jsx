import React from "react";
import { withFilterList } from "../../../HOC/withFilterList";
import { Li, Section, UiFilter, Ul } from "../../../styles/menu/MenuFilterStyles/filterProduto";
import { Div, Location } from "../../../styles/routes/produto/ProdutoStyle";
import { P } from "../../../styles/ui/uis";

export function FilterProduto({activefilter, desactivefilter,children}){
    
    function handleFilter(){
        activefilter();
    }

    function hiddenFilter(){
        desactivefilter();
    }

    return(
        <Section>
            <UiFilter>
                <P>Filtrar Produtos</P>
                <hr style={{borderColor: "rgba(3, 4, 94, 0.5)"}}/>
                <Ul>
                    <Li theme={{color: "#03045EB2"}} onClick={hiddenFilter}>Limpar filtro</Li>
                </Ul>
            </UiFilter>

            <UiFilter>
                <P>Categorias</P>
                <hr style={{borderColor: "rgba(3, 4, 94, 0.5)"}}/>
                <Ul>
                    <Li theme={{color: "#03045EB2"}} onClick={handleFilter}>Coleira</Li>
                    <Li theme={{color: "#03045EB2"}} onClick={handleFilter}>Ração</Li>
                    <Li theme={{color: "#03045EB2"}} onClick={handleFilter}>Brinquedos</Li>
                    <Li theme={{color: "#03045EB2"}} onClick={handleFilter}>Cama</Li>
                </Ul>
            </UiFilter>
            {children}
        </Section>
    )
}

export function OtherFilterList(){


    return(
        <>
            <UiFilter>
                <P>Faixa de preço</P>
                <hr style={{borderColor: "rgba(3, 4, 94, 0.5)"}}/>
                <Ul>
                    <Li theme={{color: "#03045EB2"}}>Coleira</Li>
                    <Li theme={{color: "#03045EB2"}}>Ração</Li>
                    <Li theme={{color: "#03045EB2"}}>Brinquedos</Li>
                    <Li theme={{color: "#03045EB2"}}>Cama</Li>
                </Ul>
            </UiFilter>

            <UiFilter>
                <P>Tipos</P>
                <hr style={{borderColor: "rgba(3, 4, 94, 0.5)"}}/>
                <Ul>
                    <Li theme={{color: "#03045EB2"}}>peitoral</Li>
                    <Li theme={{color: "#03045EB2"}}>plana/tradicional</Li>
                </Ul>
            </UiFilter>
        </>
        
    )
}

const FilterProdutos = withFilterList(FilterProduto);
export default FilterProdutos;