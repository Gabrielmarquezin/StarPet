import React from "react";
import { useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import Swal from "sweetalert2";
import { Footer } from "../../component/footer/footer";
import { FormPay } from "../../component/form/payment/form";
import { useAuth } from "../../hook/useAuth";
import { StylesAdocao } from "../../styles/form/StylesAdocao";

const dominio = process.env.API_KEY;

export function AdotarPet(){
    const location = useLocation();
    const navigate = useNavigate()
  
    useEffect(()=>{
        const result = Swal.fire({
            title: 'Tem certeza dessa operação?',
            text: "Ao preencher suas informações, nos entraremos em contato com você para ajustar o contrato, saiba que essa é uma operação seria. Quando finalizar suas informações, voce ainda nao terminou seu pedido, a finalização se da via whatsapp.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'continuar',
            confirmButtonColor: '#3085d6'

          })

        .then(result => {
            if (!result.isConfirmed){
                navigate(-1);
            }
        })
            
    }, [])

    async function submitAdotar(e){
        
        const params = new URLSearchParams(location.search);
        let cod = params.get("codProduto")

        e.preventDefault();

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
        formData.append("cod_user", 1)
        formData.append("cod_pet", cod)
        formData.append("quantidade", "1")
        formData.append("preco", "0.10")
        formData.append("city", city.value)
        formData.append("uf", uf.value)

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
            const request = await fetch(dominio+"/StarPet/backend/pedido/adocao/add", {
                method: "POST",
                mode: "cors",
                body: formData
            });
            const response = await request.json();

            Swal.close();

            if(response.message == "pedido adicionado"){
                Swal.fire({
                    title: "Parabéns, mas ta quase la",
                    text: "para finalizar seu pedido você recebera uma mensagem ou um email, para mais informaçoes entre em contato com nosso whatsapp: 85991022800",
                    icon: "success",
                    confirmButtonText: "OK"
                });
                return;
            }

            Swal.fire({
                title: "Ops!, houve um erro",
                text: response.message || response,
                icon: "error",
                confirmButtonText: "OK"
            });
        } catch (error) {
            Swal.close();
            Swal.fire({
                title: "Ops!, houve um erro no servidor",
                text: "tente novamente mais tarde",
                icon: "error",
                confirmButtonText: "OK"
            });  
            console.log({error: error})
        }
    }
    return(
        <>
        <StylesAdocao>
            <FormPay submit={submitAdotar} />
        </StylesAdocao>
        <Footer />
        </>
    )
}