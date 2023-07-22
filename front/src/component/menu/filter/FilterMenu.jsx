import React from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { withFilterList } from "../../../HOC/withFilterList";
import { Li, Section, UiFilter, Ul } from "../../../styles/menu/MenuFilterStyles/filterProduto";
import { StyledLink } from "../../../styles/menu/menu_styles";
import { P } from "../../../styles/ui/uis";

export function FilterProduto({activefilter, desactivefilter,children}){
    const location = useLocation();
    const navigate = useNavigate();

    const path = location.pathname.split("/");
   
    function handleFilter(){
        activefilter();
    }

    function hiddenFilter(){
        desactivefilter();

        path.splice(path.length -2, 2)
        path.push("pet")
        path.push("todos")
       
        navigate(path.join("/"))
    }

    function ChangetPath(prevUri, currentUri){
        path.splice(path.length - 2, 2)
        path.push(prevUri);
        path.push(currentUri);

        return path.join("/")
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
                    <Li onClick={handleFilter}><StyledLink style={{color: "#03045E"}} to={ChangetPath("produto","coleira")}>Coleira</StyledLink></Li>
                    <Li onClick={handleFilter}><StyledLink style={{color: "#03045E"}} to={ChangetPath("produto","racao")}>Ração</StyledLink></Li>
                    <Li onClick={handleFilter}><StyledLink style={{color: "#03045E"}} to={ChangetPath("produto","brinquedos")}>Brinquedos</StyledLink></Li>
                    <Li onClick={handleFilter}><StyledLink style={{color: "#03045E"}} to={ChangetPath("produto","cama")}>Cama</StyledLink></Li>
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
            </UiFilter>
        </>
        
    )
}

export function FilterSearchProdutos(){
   
    return(
        <Section>
            <UiFilter style={{marginTop: "0px"}}>
                <P>PETS</P>
                <hr style={{borderColor: "rgba(3, 4, 94, 0.5)"}}/>
                <Ul style={{marginTop: "30px"}}>
                    <Li><StyledLink style={{color: "#03045E"}} to={"/cachorro/pet/todos"}>Cachorro</StyledLink></Li>
                    <Li><StyledLink style={{color: "#03045E"}} to={"/gato/pet/todos"}>Gatos</StyledLink></Li>
                    <Li><StyledLink style={{color: "#03045E"}} to={"/peixe/pet/todos"}>Peixes</StyledLink></Li>
                </Ul>
            </UiFilter>
        </Section>
    )
}

const FilterProdutos = withFilterList(FilterProduto);
export default FilterProdutos;