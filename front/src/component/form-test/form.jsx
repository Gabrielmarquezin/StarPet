import { async } from "@firebase/util";
import React from "react";
import { useRef } from "react";
import { Formm, Label, StyleContainerForm } from "../../styles/form-test/form";
import { Button, Div, Input } from "../../styles/ui/uis";

const dominio = process.env.API_Key;

export function Form(){

    const nome = useRef();
    const descricao = useRef();
    const preco = useRef();
    const quantidade = useRef();

    const form = useRef();

    async function handleForm(e){

       e.preventDefault();
        try {
          const request = await fetch("http://localhost:3000/StarPet/backend/products/add", {
               method: "POST",
               mode: 'cors',
               headers: {
                    "Content-Type": "application/json",
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                  },
               body: JSON.stringify({
                    photo: "",
                    fichatecnica: {
                         linha: "",
                         modelo: "",
                         marca: "",
                         tamanho: "",
                         cor: "",
                         estoque: 5
                    },
                    categoria: "cachorro",
                    descricao: "esse cara e foda",
                    preco: 14,
                    quantidade: 1,
                    nome: "jobin",
                    tipo: "coleira"
               })
          })

          const response = await request.json();
          console.log(response)
        } catch (error) {
          console.log(error)
        }
    }

    async function MultPartHandle(e){
          e.preventDefault();
          const formData = new FormData(form.current);
          formData.append('tipo', "coleira")
          formData.append('fichatecnica', JSON.stringify({
               linha: "",
               modelo: "",
               marca: "",
               tamanho: "",
               cor: "",
               estoque: 5
             }));

             console.log(formData);

             try {
               const request = await fetch("http://localhost:3000/StarPet/backend/products/add", {
                    method: "POST",
                    mode: 'cors',
                    body: formData
               })
               const response = await request.json();
               console.log(response)
             } catch (error) {
               console.log(error)
             }
    }

    return(
       <StyleContainerForm>
            <Formm action="http://localhost:3000/StarPet/backend/products/add" method="post" encType='multipart/form-data' ref={form}>
                <Div className="input-group">
                     <Label>NOME</Label>
                     <Input type={"text"} id={"btn"} ref={nome} name="nome"/>
                </Div>
                <Div className="input-group">
                     <Label>DESCRIÇÃO</Label>
                     <Input type={"text"} id={"btn"} ref={descricao} name="descricao"/>
                </Div>
                <Div className="input-group">
                     <Label>PREÇO</Label>
                     <Input type={"number"} id={"btn"} ref={preco} name="preco"/>
                </Div>
                <Div className="input-group">   
                     <Label>QUANTIDADE</Label>
                     <Input type={"number"} id={"btn"} name="quantidade" ref={quantidade}/>
                </Div>

                <Div className="input-group">   
                     <Label>categoria</Label>
                     <Input type={"text"} id={"btn"} name="categoria" />
                </Div>

                <Div className="input-group">   
                     <Label>photo</Label>
                     <Input type={"text"} id={"btn"} name="photo"/>
                </Div>

                <Button type="submit" onClick={MultPartHandle}>ENVIAR</Button>
            </Formm>
       </StyleContainerForm>
    )
}