import React from "react";
import { useState } from "react";
import { useRef } from "react";
import { useContext } from "react";
import { GetFile } from "../../../functions/File";
import { withLoading } from "../../../HOC/withLoading";
import { PerfilContext } from "../../../routes/user/Perfil";
import { Form, Label } from "../../../styles/ui/form";
import { Div, Input } from "../../../styles/ui/uis";
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const dominio = process.env.API_KEY;

export function FormPerfil({setLoading}){

    const {DataUser} = useContext(PerfilContext)

    const form = useRef()
    const [value, setValue] = useState({
        bairro: DataUser[0].bairro,
        rua: DataUser[0].rua,
        casa_numero: DataUser[0].casa
    });

    function handleInput(e){
        let {name, value} = e.target
        setValue(prevValues => ({
            ...prevValues,
            [name]: value
        }))
    }

    async function SubmitDatas(e){
        e.preventDefault();
        e.target.disabled = true
        const formData = new FormData(form.current)
        const filee = await GetFile(DataUser[0].photo)

        formData.append("photo", filee, "user.jpg")
        formData.append("cod_user", DataUser[0].cod)

        console.log(formData);
        try {
            const request = await fetch(dominio+"/StarPet/backend/users/update", {
                method: "POST",
                mode: "cors",
                body: formData
            })

            const response = await request.json();
            e.target.disabled = false
            
            if(response.message == "User nao existe ou nao ha o que atualizar"){
                Swal.fire({
                    title: "Eae",
                    text: "Nao ha o que atualizar, adicione novos dados",
                    icon: "error",
                    confirmButtonText: "OK"
                })

                return;
            }
            Swal.fire({
                title: "Hellow",
                text: "Seus dados foram atualizados",
                icon: "success",
                confirmButtonText: "OK"
            })
        } catch (error) {
            console.log(error)
        }
    }

    return(
        <Form action={dominio+""} encType="multiform/form-data" method="POST" ref={form}>
            <Div className="ui-input-group">
                <Label htmlFor="nome">Nome</Label>
                <Input type={"text"} name="nome" id="nome" value={DataUser[0].nome} disabled/>
            </Div>

            <Div className="ui-input-group">
                <Label htmlFor="email">Email</Label>
                <Input type={"text"} name="email"  id="email" value={DataUser[0].email} disabled/>
            </Div>

            <Div className="ui-input-group">
                <Label htmlFor="bairro">Bairro</Label>
                <Input type={"text"} name="bairro"  id="bairro" value={value.bairro} onChange={handleInput}/>
            </Div>

            <Div className="ui-input-group">
                <Label htmlFor="rua">Rua</Label>
                <Input type={"text"} name="rua"  id="rua" value={value.rua}  onChange={handleInput}/>
            </Div>

            <Div className="ui-input-group">
                <Label htmlFor="casa">Casa</Label>
                <Input type={"text"} name="casa_numero"  id="casa" value={value.casa_numero} onChange={handleInput}/>
            </Div>

            <Div className="ui-input-submit">    
                <Input type={"submit"} value={"ATUALIZAR"} onClick={SubmitDatas}/>
            </Div>
        </Form>
    )
}

export const WithLoadingForm = withLoading(FormPerfil)