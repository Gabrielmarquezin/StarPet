import React from "react";
import { useEffect } from "react";
import { useContext } from "react";
import { useState } from "react";
import Swal from "sweetalert2";
import { GetFile } from "../../../../functions/File";
import { withLoading } from "../../../../HOC/withLoading";
import { ProdutoContext } from "../../../../routes/adm/EditProduto";
import { Form, TextArea } from "../../../../styles/ui/form";
import { Button, Div, Input } from "../../../../styles/ui/uis";
import { InputFile } from "../../components/inputFile";

const dominio = process.env.API_KEY;

function FormProdutoUpdate({submit}){

    const {produto} = useContext(ProdutoContext);

    const [value, setValue] = useState({
        preco: '',
        nome: '',
        descricao: '',
        photo: '',
        cod: ''
    });

    
    useEffect(()=>{
        setValue({
            preco: produto.preco,
            nome: produto.nome,
            descricao: produto.descricao,
            photo: produto.photo,
            cod: produto.cod
        })
    }, [produto])

    function changeValue(e){
        let {name, value} = e.target
        setValue(prevValues => ({
            ...prevValues,
            [name]: value
        }))
    }

    function moveForm(){
        const container = document.querySelector(".ui-container-product");
        container.style.transform = "translateX(0)";
    }

    return(
        <Form action="" id="form-update">
            <Div className="input-group">
                <Input type={"text"} placeholder="nome" name="nome" value={value.nome} onChange={changeValue} />
            </Div>
            <Div className="input-group">
                <TextArea placeholder="descrição" name="descricao" value={value.descricao} onChange={changeValue} />
            </Div>
            <Div className="input-group input-box">
                <Div className="ui-preco">
                    <Input type={"text"} placeholder="preço" name="preco" value={value.preco} onChange={changeValue}/>
                </Div>
                <InputFile name={"photo"} src={value.photo}/>
            </Div>
            <Div className="buttons-input">
                <Button type="button" onClick={moveForm}>VOLTAR</Button>
                <Input type={"submit"} value="ENVIAR" onClick={submit}/>
            </Div>
        </Form>
    )
}


const FormProdutowithLoading = withLoading(FormProdutoUpdate);

export function ContainerForm(){
    const {produto, route} = useContext(ProdutoContext);
   
    async function handleSubmit(e){
        e.preventDefault();
        e.target.disabled = true;

        const form = document.getElementById('form-update');
        const formData = new FormData(form);
        formData.append("cod", produto.cod)

        if(formData.get("photo").size == 0){
            formData.delete("photo");

            const file = await GetFile(produto.photo);
            formData.append("photo", file)
        }
        
        try {
            
            const response = await fetchUp(formData);
            e.target.disabled = false;
            console.log(response)
            if(response.message == "atualizado"){
                Swal.fire({
                    title: "Hellow",
                    text: "Seu produto foi atualizado",
                    icon: "success",
                    confirmButtonText: "OK"
                })
            }

           if(response.message == "Produto nao existe ou produto nao tem o que atualizar" || response.message == "Pet nao existe ou pet nao tem o que atualizar"){
                Swal.fire({
                    title: "Error",
                    text: "Modifique algum dado para atualizar",
                    icon: "error",
                    confirmButtonText: "OK"
                })
           }
        } catch (error) {
            console.log(error);
        }
    }

    async function fetchUp(data){
        let link = "";

        switch(route){
            case "produto":
                link = `/StarPet/backend/products/update`
                break;

            case "pet": 
                link = "/StarPet/backend/products/pet/update"
                break;

            case "pet_adocao":
                link = "/StarPet/backend/products/pet/adocao/update"
                break;
            
            default: 
                link = "/StarPet/backend/products/update"
        }

        try {
            const request = await fetch(dominio+link,{
                method: "POST",
                mode: "cors",
                body: data
            })

            const response = await request.json();

            return response;
        } catch (error) {
           throw new Error(error)
        }
    }
    
    return(
        <FormProdutowithLoading isloading={false} submit={handleSubmit}/>
    )
}