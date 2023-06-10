import React, { useRef, useState } from "react";
import Swal from "sweetalert2";
import { withLoading } from "../../../HOC/withLoading";
import { Form, Option, Select, TextArea } from "../../../styles/ui/form";
import { Div, Input } from "../../../styles/ui/uis";
import { InputFile } from "../components/inputFile";
import { FichaPet } from "./components/ficha_pet";

const dominio = process.env.API_KEY

function FormPet({submit}){

    const form = useRef();

    function nextForm(){
        form.current.style.transform = "translateX(-100%)"    
    }

    function prevForm(){
        form.current.style.transform = "translateX(0)" 
    }

    function handlePreco(e){
        let valor = e.target.value;
        let novoValor = valor.replace(/,/g, '.');

        e.target.value = novoValor;
    }

    return(
        <Form id="ui-form-pet" ref={form}>
            <Div className="front">
                <Div className="input-group">
                    <Input type={"text"} placeholder="Nome do Pet" name="nome" />
                </Div>

                <Div className="input-group">
                    <TextArea type={"text"} name="descricao" placeholder="Descrição"/>
                </Div>
                <Div className="input-group">
                    <Div className="input-box">
                        <Select placeholder="categoria" name="categoria">
                            <Option value={"cachorro"}>Cachorro</Option>
                            <Option value={"gato"}>Gato</Option>
                            <Option value={"peixe"}>Peixe</Option>
                            <Option value={"passaro"}>Pássaro</Option>
                        </Select>
                        
                        <Div className="box">
                            <Input type={"number"} placeholder="quantidade" name="quantidade" />
                            <Input type={"text"} placeholder="preço" name="preco" onChange={handlePreco}/>
                        </Div>
                    </Div>

                    <InputFile name={"photo"} />
                </Div>
                <Div className="buttons">
                    <Input type={"button"} value="Proximo" onClick={nextForm}/>
                </Div>
            </Div>

            <Div className="back">
                <FichaPet />
                <Div className="buttons">
                    <Input type={"button"} value="Voltar"  onClick={prevForm}/>
                    <Input type={"submit"} value={"Enviar"} onClick={submit} />
                </Div>
            </Div>
        </Form>
    )
}

const FormPetWithLoading = withLoading(FormPet);

export function ContainerFormPet(){
    const [loading, setLoading] = useState(false)

    async function handleSubmit(e){
        e.preventDefault();
        const form = document.getElementById("ui-form-pet")
        const formData = new FormData(form)

        const fichaPet = {
            raca: formData.get("raca"),
            alergias: formData.get("alergias"),
            observacoes: formData.get("observacoes"),
            tamanho: formData.get("tamanho"),
            estoque: formData.get("estoque")
        }

        formData.append("ficha_pet", JSON.stringify(fichaPet));
        
        setLoading(true)
        try {
            const request = await fetch(dominio+"/StarPet/backend/products/pet/add", {
                method: "POST",
                mode: "cors",
                body: formData
            });
            const response = await request.json();

            if(response.status){   
                Swal.fire({
                    title: "Hellow",
                    text: "Pet foi adicionado com sucesso",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            }

            if(response.message){
                Swal.fire({
                    title: "Ops!, houve um erro",
                    text: response.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
            setLoading(false)
        } catch (error) {
            setLoading(false)
            console.log(error)
        };
    }
    return(
        <FormPetWithLoading submit={handleSubmit} isloading={loading} />
    )
}