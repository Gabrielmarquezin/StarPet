import React, { useRef } from "react";
import { Form, TextArea } from "../../../styles/ui/form";
import { Div, Input } from "../../../styles/ui/uis";
import { InputFile } from "../components/inputFile";
import Swal from 'sweetalert2';
import { withLoading } from "../../../HOC/withLoading";
import { useState } from "react";

const dominio = process.env.API_KEY;

function ProdutoCadastro({submit}){
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
        <Form action="" method="POST" ref={form} id="form-produto-add">
            <Div className="front">
                <Div className="input-group">
                    <Input type={"text"} name={"nome"} placeholder="Nome" />
                </Div>
                <Div className="input-group">
                    <TextArea placeholder="Descrição" name="descricao" />
                </Div>
                <Div className="input-group">
                    <Input type={"text"} name={"categoria"} placeholder="Categoria" />
                </Div>
                <Div className="input-group">
                    <Input type={"text"} name={"tipo"} placeholder="Tipo" />
                </Div>
                <Div className="input-group">
                    <Div className="input-box">
                        <Input type={"number"} name={"quantidade"} placeholder="Quantidade" />
                        <Input type={"text"} name={"preco"} placeholder="Preco" onKeyUp={handlePreco}/>
                    </Div>
                    <InputFile name={"photo"}/>
                </Div>
                <Div className="buttons">
                    <Input type={"button"} value="Proximo" onClick={nextForm}/>
                </Div>
            </Div>

            <Div className="back">
                <Div className="input-group">
                    <Input type={"text"} name={"linha"} placeholder="Linha" />
                </Div>
        
                <Div className="input-group">
                    <Input type={"text"} name={"modelo"} placeholder="modelo" />
                </Div>
                <Div className="input-group">
                    <Input type={"text"} name={"marca"} placeholder="marca" />
                </Div>
                <Div className="input-group">
                    <Input type={"text"} name={"tamanho"} placeholder="tamanho" />
                </Div>
                <Div className="input-group">
                    <Input type={"text"} name={"cor"} placeholder="cor" />
                </Div>
                <Div className="input-group">
                    <Input type={"text"} name={"estoque"} placeholder="estoque" />
                </Div>
                <Div className="buttons">
                    <Input type={"button"} value="Voltar" onClick={prevForm} />
                    <Input type={"submit"} value={"Enviar"} onClick={submit}/>
                </Div>
            </Div>
        </Form>
    )
}

const ProdutoCadastroWithLoading = withLoading(ProdutoCadastro);

export function ContainerProduto(){
    const [loading, setLoading] = useState(false);

    async function handleSubmit(e){
        e.preventDefault();

        const form = document.getElementById("form-produto-add");
        const formData = new FormData(form);
        const fichaTecnica = {
            linha: formData.get("linha"),
            modelo: formData.get("modelo"),
            marca: formData.get("marca"),
            tamanho: formData.get("tamanho"),
            cor: formData.get("cor"),
            estoque: formData.get("estoque")
        }
        formData.append("fichatecnica", JSON.stringify(fichaTecnica));
        
        try {
            setLoading(true)
            const request = await fetch(dominio+"/StarPet/backend/products/add",{
                method: "POST",
                mode: "cors",
                body: formData
            })
            const response = await request.json();
            setLoading(false)
            if(response.message == "descricao too long"){
                Swal.fire({
                    title: "Error",
                    text: "Descriçao muito longa, exclua alguns caracteres",
                    icon: "error",
                    confirmButtonText: "OK"
                })
                return;
            }

            if(response.message == "valores obrigatorios: photo, preco, quantidade e categoria"){
                Swal.fire({
                    title: "Error",
                    text: "Alguns campos estao vazio, verifique a foto, preço, quantidade e a categoria",
                    icon: "error",
                    confirmButtonText: "OK"
                })
                return;
            }

            Swal.fire({
                title: "Hellow",
                text: "Produto foi adicionado com sucesso",
                icon: "success",
                confirmButtonText: "OK"
            });

        } catch (error) {
            console.log(error)
        }
    }

    return(
        <ProdutoCadastroWithLoading isloading={loading} submit={handleSubmit} />
    )
}
