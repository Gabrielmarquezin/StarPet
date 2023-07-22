import React from "react";
import styles from "../../../styles/menu/styles.module.css";
import { Li, StyledLink, Ul } from "../../../styles/menu/menu_styles";

export function Lista(){
    return(
        <div className={styles.container_list}>
            <Ul>
                <Li><StyledLink to={"/"}>Home</StyledLink></Li> 
                <Li>
                    <StyledLink to={"cachorro/pet/todos"}>Cachorros</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/cachorro/produto/coleira"}>Coleiras</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/cachorro/produto/racao"}>Ração</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/cachorro/produto/brinquedos"}>Brinquedos</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/cachorro/produto/cama"}>Cama</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"gato/pet/todos"}>Gatos</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/gato/produto/coleira"}>Coleiras</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/gato/produto/contatos"}>Ração</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/gato/produto/brinquedos"}>Brinquedos</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/gato/produto/cama"}>Cama</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"peixe/pet/todos"}>Peixes Ornamentais</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/peixe/pet/beta"}>Beta</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/peixe/pet/fungo"}>Peixe Fungo</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/peixe/pet/marino"}>Marino</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/peixe/pet/carpos"}>Carpos</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"#"}>outros animais</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/passaro/pet/gaiolas"}>Gaiolas</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/passaro/pet/argolas"}>Acessórios</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"/passaro/pet/racao"}>Alimentos</StyledLink></Li>
                    </Ul>
                </Li>
                <Li>
                    <StyledLink to={"#"}>Serviços</StyledLink>
                    <Ul theme={"pet-blue"}>
                        <Li><StyledLink color="#03045E" to={"/pedido/banho_tosa"}>Banhos e tosas</StyledLink></Li>
                        <Li><StyledLink color="#03045E" to={"pet/adocao"}>Adoção</StyledLink></Li>
                    </Ul>
                </Li>
            </Ul>
        </div>
    );
}

export function ListAdm(){
    return(
        <div className={styles.container_list}>
            <Ul>
                <Li><StyledLink to={"/"}>Home</StyledLink></Li> 
                <Li>
                    <StyledLink to={"cadastrar"}>cadastrar Produto</StyledLink>
                </Li>
            </Ul>
        </div>
    );
}