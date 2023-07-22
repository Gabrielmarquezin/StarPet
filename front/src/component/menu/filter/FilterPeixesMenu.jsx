import React from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { withFilterList } from "../../../HOC/withFilterList";
import { Li, Section, UiFilter, Ul } from "../../../styles/menu/MenuFilterStyles/filterProduto";
import { StyledLink } from "../../../styles/menu/menu_styles";
import { P } from "../../../styles/ui/uis";


export function FilterPeixeMenu(){
    const location = useLocation();
    const navigate = useNavigate();

    const path = location.pathname.split("/");

    function hiddenFilter(){
        //desactivefilter();

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

            <UiFilter style={{marginTop: "0px"}}>
                <P>PETS</P>
                <hr style={{borderColor: "rgba(3, 4, 94, 0.5)"}}/>
                <Ul style={{marginTop: "30px"}}>
                    <Li><StyledLink style={{color: "#03045E"}} to={ChangetPath("pet","beta")}>Beta</StyledLink></Li>
                    <Li><StyledLink style={{color: "#03045E"}} to={ChangetPath("pet","fungo")}>Peixe Fungo</StyledLink></Li>
                    <Li><StyledLink style={{color: "#03045E"}} to={ChangetPath("pet","marino")}>Marino</StyledLink></Li>
                    <Li><StyledLink style={{color: "#03045E"}} to={ChangetPath("pet","carpos")}>Carpos</StyledLink></Li>
                </Ul>
            </UiFilter>
        </Section>
    )
}