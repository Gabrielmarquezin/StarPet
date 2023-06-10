import React from "react";
import { useState } from "react";
import Swal from "sweetalert2";
import { AdmMenuV } from "../../component/screens/adm/menu";
import { withLoading } from "../../HOC/withLoading";
import { Section } from "../../styles/routes/produto/editProdutoStyle";
import { Option, Select } from "../../styles/ui/form";
import { Button, Div, Input, Span } from "../../styles/ui/uis";

const dominio = process.env.API_KEY;

function SectionTrash({submit}){
    return(
        <Section style={{width: "100%"}}>
            <Div className="ui-container-product" style={{height: "100%"}}>
                <Div className="ui-container-codigo">
                    <Div className="box">
                        <Select id="ui-select-trash">
                            <Option value={"produto"}>Produto</Option>
                            <Option value={"pet"}>Pet</Option>
                            <Option value={"pet_adocao"}>Pet Adoção</Option>
                        </Select>

                        <Input type={"text"} placeholder="Digite o codigo do produto" id="ui-input-trash"/>
                        <Span id="ui-span">Codigo obrigatorio</Span>
                    </Div>
                    <Button type="button" onClick={submit} id="ui-button-trash">deletar</Button>
                </Div>
            </Div>
        </Section>
    )
}

const SectionTrashWithLoading = withLoading(SectionTrash);

export function TrashProduto(){
    const [loading, setLoading] = useState(false)
   
      async function handleTrash(e){
        
        const input = document.getElementById("ui-input-trash")
        const span = document.getElementById("ui-span")
        const btn = document.getElementById("ui-button-trash")
        
        const cod = input.value;
        var data;
        
        if(isNaN(cod)){
            Swal.fire({
                title: "Error",
                text: "insira um codigo valido",
                icon: "error",
                confirmButtonText: "OK"
            })

            return;
        }
        
        if(cod == ""){
            input.classList.add("error-input")
            span.classList.add("error-span")

            return;
        }else{
            input.classList.remove("error-input")
            span.classList.remove("error-span")
        }
        
        btn.disabled = true;

        try {
            const result = await Swal.fire({
                title: 'Tem certeza dessa operação?',
                text: "Ao excluir o produto, você não podera reverter essa ação",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'apagar',
                confirmButtonColor: '#3085d6'
    
              })

            if (result.isConfirmed){
                setLoading(true)

                fetchDelete(cod)
                .then((data)=>{
                    setLoading(false)
                    if(data.error == "Produto nao existe" || data.message == "Pet nao existe"){
                        Swal.fire({
                            title: "Error",
                            text: "item nao encontrado, digite um codigo que exista",
                            icon: "error",
                            confirmButtonText: "OK"
                        })
                    }else{
                        Swal.fire({
                            title: "Helow",
                            text: "Seu item foi excluido",
                            icon: "success",
                            confirmButtonText: "OK"
                        })
                    }
                })
                .catch(error => {
                    setLoading(false)
                });
            }

            btn.disabled = false;
        } catch (error) {
            setLoading(false)
        }
    }

    async function fetchDelete(cod){
        const select = document.getElementById("ui-select-trash").value
        let link = "";
        let body;

        switch(select){
            case "produto":
                link = "/StarPet/backend/products/delete"
                body = JSON.stringify({"idProduto": cod})
                break;

            case "pet":
                link = "/StarPet/backend/products/pet/delete"
                body = JSON.stringify({"idPet": cod})
                break;

            case "pet_adocao":
                link = "/StarPet/backend/products/pet/adocao/delete"
                body = JSON.stringify({"idPet": cod})
                break;
        }

        try {
            const request = await fetch(dominio+link, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: body
            })

            const response = await request.json();
            return response;
        } catch (error) {  
            console.log(error)
            throw new Error(error);
        }
    }

    return(
        <AdmMenuV>
            <SectionTrashWithLoading isloading={loading} submit={handleTrash} />
        </AdmMenuV>
    )
}

