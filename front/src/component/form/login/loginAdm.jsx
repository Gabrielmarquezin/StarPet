import React from "react";
import { StyleForm } from "../../../styles/form/StyleAdm";
import { Form } from "../../../styles/ui/form";
import { Div, Input } from "../../../styles/ui/uis";
import { AiFillEye, AiFillEyeInvisible } from "react-icons/ai";
import { useRef } from "react";
import Swal from 'sweetalert2';
import { useNavigate } from "react-router-dom";
import { useState } from "react";
import { withLoading } from "../../../HOC/withLoading";

const dominio = process.env.API_KEY

function LoginAdm({setLoading}){

    const [visible, setVisible] = useState(false);

    const email = useRef();
    const senha = useRef();

    const navigate = useNavigate();

    async function handleSubmit(e){
        e.preventDefault();

        setLoading(true)
        try {
            const request = await fetch(dominio+`/StarPet/backend/adm?email=${email.current.value}&senha=${senha.current.value}`)
            const response = await request.json();

            setLoading(false)
            if(response.message){
                Swal.fire({
                    title: "ERROR",
                    text: "Adm nao existe",
                    icon: "error",
                    confirmButtonText: "OK"
                })
            }else{
                localStorage.setItem("cod_adm", response[0].cod)
                navigate(`/adm/home`)
            }
        } catch (error) {
            console.log(error)
        }
    }

    function setEye(){
        setVisible((prevValue) => !prevValue)
    }

    return(
        <Form action="" method="GET" encType="multiform/form-data">
            <Div className="input-group">
                <Input type={"text"} placeholder="email" name="email" ref={email}/>
            </Div>
            <Div className="input-group password">
                <Input type={visible ? "text" : "password"} placeholder="senha" name="senha" ref={senha}/>
                <Div className="icon-group">
                {visible ? <AiFillEye className="icon" onClick={setEye} /> : <AiFillEyeInvisible className="icon" onClick={setEye} />}
                </Div>
            </Div>
            <Input type={"submit"} value="LOGIN" onClick={handleSubmit} />
        </Form>
    )
}

export const LoginAdmWithLoading = withLoading(LoginAdm);