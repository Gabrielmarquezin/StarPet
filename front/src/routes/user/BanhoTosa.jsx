import { async } from "@firebase/util";
import React from "react";
import { useState } from "react";
import { GiElderberry } from "react-icons/gi";
import { useNavigate } from "react-router-dom";
import Swal from "sweetalert2";
import { Footer } from "../../component/footer/footer";
import { FormPay } from "../../component/form/payment/form";
import { FormBanho } from "../../component/form/PetForm/banho/form";
import { Pix } from "../../component/screens/payment/pix";
import { useAuth } from "../../hook/useAuth";
import { StylesBanhoForm } from "../../styles/form/StyleBanho";
import { Button, Div } from "../../styles/ui/uis";

const dominio = process.env.API_KEY;

export function BanhoTosa(){

    const navigate = useNavigate()
    const {user} = useAuth();
    const [qrCod, setQrCod] = useState({qr_code_base64: ""})

    if(!user){
        Swal.fire({
            title: "Você não esta logado",
            text: "por favor faça seu login",
            icon: "error",
            confirmButtonText: "OK"
        }).then(value => {
            if(value.isConfirmed){
                navigate(-1)
            }
        })

        return;
    }

    function goBack(){
        const container = document.getElementById("banho");
        container.style.transform = "translateX(0%)";
    }

    async function SubmitForm(e){
        e.preventDefault();

        const container = document.getElementById("banho")
        const BanhoForm = document.getElementById("BanhoForm");
        const PaymentForm = document.getElementById("form-pedido");
        const codUser = localStorage.getItem("cod_user")

        const city = document.getElementById("city");
        const uf = document.getElementById("uf");

        let cpf = document.getElementById("cpf").value
        cpf = cpf.replace(/\D/g, '')

        let telefone = document.getElementById("telefone").value
        telefone = telefone.replace(/\D/g, '')

        let cep = document.getElementById("cep").value
        cep = cep.replace(/\D/g, '')


        //dados
        const formDataPayment = new FormData(PaymentForm);
        const formDataBanho = new FormData(BanhoForm)

        formDataPayment.set("cep", cep)
        formDataPayment.set("telefone", telefone)
        formDataPayment.set("cpf", cpf)
        formDataPayment.append("city", city.value)
        formDataPayment.append("uf", uf.value)
        formDataPayment.append("cod_user", codUser)
    
        for (const [name, value] of formDataBanho.entries()) {
            formDataPayment.append(name, value);
        }

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
            const response = await fetchPedido(formDataPayment)

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

            setQrCod(response);
            container.style.transform = "translateX(calc(-200% - 61px))";
        } catch (error) {
            Swal.close();
            Swal.fire({
                title: "Ops!, houve um erro",
                text: "erro no servidor",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }
        
    }

async function fetchPedido(data){
        try {
            const request = await fetch(dominio+"/StarPet/backend/pedido_produto/banho/add", {
                method: "POST",
                mode: "cors",
                body: data
            })

            const response = await request.json()

            return response
        } catch (error) {
            console.log(error)
            throw new Error("erro")
        }
    }

    return(
        <>
            <StylesBanhoForm>
                <Div className="container-all">
                    <Div className="form-banho" id="banho">
                        <Div className="slide">
                            <FormBanho />
                        </Div>
                        <Div className="slide">
                            <FormPay submit={SubmitForm}>
                                <Button type="button" onClick={goBack}>Voltar</Button>
                            </FormPay>
                        </Div>
                        <Div className="slide">
                            <Pix src={qrCod.qr_code_base64} />
                        </Div>
                    </Div>
                </Div>
            </StylesBanhoForm>
            <Footer />
        </>
    );
}