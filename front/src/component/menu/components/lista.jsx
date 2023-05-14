import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { Li, StyledLink, Ul } from "../../../styles/menu/menu_styles";

export function Lista(){
    return(
        <div className={styles.container_list}>
            <Ul>
                <Li>
                    <StyledLink to={"produto/cachorro/todos"}>Cachorros</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/produto/cachorro/coleira"}>Coleiras</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/produto/cachorro/racao"}>Ração</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/produto/cachorro/brinquedo"}>Brinquedos</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/produto/cachorro/cama"}>Cama</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"#"}>Gatos</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Coleiras</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Ração</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Brinquedos</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Cama</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"#"}>Peixes Ornamentais</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Beta</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Peixe Fungo</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Marino</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Carpos</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"#"}>outros animais</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Gaiolas e <br/>acessórios</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Alimentos</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"#"}>Serviços</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Banhos e tosas</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/contatos"}>Adoção</StyledLink></Li>
                    </Ul>
                </Li>
            </Ul>
        </div>
    );
}