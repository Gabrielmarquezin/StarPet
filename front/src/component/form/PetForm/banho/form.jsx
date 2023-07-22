import React from "react";
import { useNavigate } from "react-router-dom";
import { FormBanhoStyle } from "../../../../styles/form/StyleBanho";
import { StyleForm } from "../../../../styles/form/StylePayment";
import { Form, Label, Option, Select, TextArea } from "../../../../styles/ui/form";
import { Button, Div, Input, Span } from "../../../../styles/ui/uis";


export function FormBanho(){
    const navigate = useNavigate()

    function Next(){
        const container = document.getElementById("banho");
        container.style.transform = "translateX(calc(-100% - 30px))";
    }

    function goBack(){
        navigate(-1)
    }

    return(
            <StyleForm style={{display: "flex", flexDirection: "column", height: "100%"}} id="BanhoForm">
                    <Div className="input-group">
                        <Label htmlFor="pet_name">Nome do pet</Label>
                        <Input type={"text"} name="pet_name" id="pet_name" />
                    </Div>
                    <Div className="input-group">
                        <Label htmlFor="observacoes">Observaçoes sobre o pet (alergias/comportamento)</Label>
                        <TextArea name="observacoes" id="observacoes" style={{maxWidth: "100%", width: "100%", maxHeight: "300px", height: "200px"}}/>
                    </Div>
                    <Div className="input-group" style={{display: "flex", justifyContent: "space-between"}}>
                        <Select name="kit">
                            <Option value={""}>Selecione seu kit</Option>
                            <Option value={"premium"}>Kit Premium</Option>
                            <Option value={"premium"}>Kit Basico</Option>
                        </Select>
                        <Select name="cod_horario">
                            <Option value={""}>Selecione o horario</Option>
                            <Option value={2}>09:00 - 10:00</Option>
                            <Option value={3}>14:00 15:00</Option>
                        </Select>
                        <Select name="animal">
                            <Option value={""}>Qual animal?</Option>
                            <Option value={"gato"}>Gato</Option>
                            <Option value={"cachorro"}>Cachorro</Option>
                        </Select>
                    </Div>
                    <Span>PREÇO:</Span>
                    <Input type={"text"} name="preco" value={0.10} style={{width: "100px", textAlign: "center"}} readOnly />

                    <Span style={{marginTop: "20px"}}>Kit Premium: <br /> -shampoo <br /> -condicionador <br /> -limpa lagrima <br /> -tosa simples</Span>
                    <Span style={{marginTop: "20px"}}>Kit basico: <br /> -shampoo <br /> -condicionador <br /> -tosa simples <br /> </Span>  
                    <Div className="btn" style={{justifyContent: "space-between", marginTop: "50px", height: "100%", alignItems: "end"}}>
                        <Button type="button" style={{backgroundColor: "#6e7881", height: "50px"}} onClick={goBack} >CANCELAR</Button>
                        <Button type="button" style={{height: "50px"}} onClick={Next}>PROXIMO</Button>
                    </Div>
            </StyleForm>
    )
}