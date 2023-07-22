import React, { useState } from "react";
import { useEffect } from "react";
import { useContext } from "react";
import { useLocation, useSearchParams } from "react-router-dom";
import Swal from "sweetalert2";
import { ViaCep } from "../../../functions/viaCep";
import { withLoading } from "../../../HOC/withLoading";
import { PaymentContext } from "../../../routes/user/payment";
import { StyleForm } from "../../../styles/form/StylePayment";
import { Label, Form, Select, Option} from "../../../styles/ui/form";
import { Button, Div, Input, Span} from "../../../styles/ui/uis";

const dominio = process.env.API_KEY;

export function PaymentForm(){
    const {setPayment} = useContext(PaymentContext)
    const location = useLocation();
    const params = new URLSearchParams(location.search);
    
    async function handleSubmit(e){
        const type = params.get("type")
        const cod = params.get("codProduto")
        const cod_user = params.get("codUser")
        const quant = params.get("quant")
        let link;

        e.preventDefault();

        const container = document.querySelector(".container-all");
        const city = document.getElementById("city");
        const uf = document.getElementById("uf");

        let cpf = document.getElementById("cpf").value
        cpf = cpf.replace(/\D/g, '')

        let telefone = document.getElementById("telefone").value
        telefone = telefone.replace(/\D/g, '')

        let cep = document.getElementById("cep").value
        cep = cep.replace(/\D/g, '')

        const form = document.getElementById("form-pedido");
        const formData = new FormData(form);

        formData.set("cep", cep)
        formData.set("telefone", telefone)
        formData.set("cpf", cpf)
        formData.append("cod_user", cod_user)
        formData.append("cod_produto", cod)
        formData.append("quantidade", quant)
        formData.append("preco", "0.10")
        formData.append("city", city.value)
        formData.append("uf", uf.value)

        console.log(formData)
        const showLoading = () => {
            Swal.fire({
              title: 'Carregando...',
              html: 'Pode levar uns instantes',
              allowEscapeKey: false,
              allowOutsideClick: false,
              showConfirmButton: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });
          };
          
        showLoading();

        try {
            switch(type){
                case "produto":
                    link = "/StarPet/backend/pedido_produto/add"
                    break;
                case "pet":
                    link = "/StarPet/backend/pedido_produto/pet/add"
                    break;
            }
            
            const request = await fetch(dominio+link, {
                method: "POST",
                mode: "cors",
                body: formData
            });
            const response = await request.json();

            Swal.close();
            if(response.message){
                Swal.fire({
                    title: "Ops!, houve um erro",
                    text: response.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            setPayment((prev) => ({...prev, ["qr_cod"]: response.qr_code.qr_code_base64, ["id_pedido"]: response.id_pedido}))
            container.style.transform = "translateX(-100%)";
        } catch (error) {
            Swal.close()
            Swal.fire({
                title: "Ops!, houve um erro no servidor",
                text: "tente novamente mais tarde",
                icon: "error",
                confirmButtonText: "OK"
            });
            console.log({error: error})
        }
    }

    return (
        <FormPay submit={handleSubmit}/>
    )
}



export function FormPay({submit, children}){

    useEffect(()=>{
        const cod_user = localStorage.getItem("cod_user")
        if(cod_user){

        }
    }, [])

    async function getUser(cod){
        try {
            
        } catch (error) {
            
        }
    }

    function handleCepChange(e){
        let value = e.target.value
        let regex = /[a-z!@#$%¨&*(){}^~ç;,/?°\\|+=\_]/i;

        const span = document.querySelector(".ui-span-erro");
        const city = document.getElementById("city");
        const uf = document.getElementById("uf");
       
        uf.disabled = false; 
        city.disabled = false;

        if(regex.test(value)){
            span.classList.remove("error");
            return;
        }
        span.classList.add("error");

        if(value.length == 5 ){
            e.target.value = value+"-"
        }

        if(e.key == "Backspace" || e.key == "Delete"){
            city.value = ""
            uf.value = ""
        }

        if(value.length == 9){
            let cep = value.replace(/\D/g, '');
            ViaCep(cep)
            .then(data => {
                if(data.erro){
                    span.classList.remove("error");
                    return
                }
                uf.disabled = true; 
                city.disabled = true;
                uf.value = data.uf
                city.value = data.localidade
            })
        }

    }

    function changeCpf(e){
        let value = e.target.value

        if(value.length == 3 || value.length == 7){
            e.target.value = value+"."
        }

        if(value.length == 11){
            e.target.value = value+"-"
        }
    }

    function changeTel(e){
        let value = e.target.value;

        if(value.length == 1){
            e.target.value = "("+value
        }
        if(value.length == 3){
            e.target.value = value+")"
        }
    }

    return(
        <StyleForm id="form-pedido">
            <Div className="input-group">
                <Label htmlFor="email" >DIGITE SEU EMAIL</Label>
                <Input type={"email"} name="email" id="email" />
            </Div>
            <Div className="input-group">
                <Label htmlFor="telefone">DIGITE SEU TELEFONE</Label>
                <Input type={"tel"} name="telefone" id="telefone" onKeyUp={changeTel} maxLength="13"/>
            </Div>
            <Div className="input-group">
                <Span>DIGITE SEU ENDEREÇO</Span>
                <Div>
                    <Label htmlFor="rua" >RUA</Label>
                    <Input type={"text"} name="rua" id="rua" />
                </Div>
                <Div>
                    <Label htmlFor="bairro" >BAIRRO</Label>
                    <Input type={"text"} name="bairro" id="bairro" />
                </Div>
                <Div className="box">
                   <Div>
                        <Label htmlFor="cep" >CEP</Label>
                        <Input type={"text"} name="cep" id="cep" onKeyUp={handleCepChange} maxLength={"9"}/>
                        <Span className="ui-span-erro error">Cep invalido</Span>
                   </Div>
                   <Div>
                        <Label htmlFor="city" >CIDADE</Label>
                        <Input type={"text"} name="city" id="city" />
                   </Div>
                   <Div>
                        <Label htmlFor="uf" >UF</Label>
                        <Select name="uf" id="uf">
                            <Option value="">Selecione</Option>
                            <Option value="AC">Acre</Option>
                            <Option value="AL">Alagoas</Option>
                            <Option value="AP">Amapá</Option>
                            <Option value="AM">Amazonas</Option>
                            <Option value="BA">Bahia</Option>
                            <Option value="CE">Ceará</Option>
                            <Option value="DF">Distrito Federal</Option>
                            <Option value="ES">Espirito Santo</Option>
                            <Option value="GO">Goiás</Option>
                            <Option value="MA">Maranhão</Option>
                            <Option value="MS">Mato Grosso do Sul</Option>
                            <Option value="MT">Mato Grosso</Option>
                            <Option value="MG">Minas Gerais</Option>
                            <Option value="PA">Pará</Option>
                            <Option value="PB">Paraíba</Option>
                            <Option value="PR">Paraná</Option>
                            <Option value="PE">Pernambuco</Option>
                            <Option value="PI">Piauí</Option>
                            <Option value="RJ">Rio de Janeiro</Option>
                            <Option value="RN">Rio Grande do Norte</Option>
                            <Option value="RS">Rio Grande do Sul</Option>
                            <Option value="RO">Rondônia</Option>
                            <Option value="RR">Roraima</Option>
                            <Option value="SC">Santa Catarina</Option>
                            <Option value="SP">São Paulo</Option>
                            <Option value="SE">Sergipe</Option>
                            <Option value="TO">Tocantins</Option>
                        </Select>
                   </Div>
                   <Div>
                        <Label htmlFor="casa" >Numero</Label>
                        <Input type={"text"} name="casa_number" id="casa" />
                   </Div>
                </Div>
            </Div>
            <Div className="input-group">
                <Span>Pagamento</Span>
                <Div>
                    <Label htmlFor="nome" >NOME PIX</Label>
                    <Input type={"text"} name="nome" id="nome" />
                 </Div>
                <Div>
                    <Label htmlFor="cpf" >CPF</Label>
                    <Input type={"text"} name="cpf" id="cpf" onKeyUp={changeCpf} maxLength={"14"}/>
                 </Div>
            </Div>
            <Div className="btn">
                {children}
                <Button type="submit" onClick={submit}>ENVIAR</Button>
            </Div>
        </StyleForm>
    )
}
