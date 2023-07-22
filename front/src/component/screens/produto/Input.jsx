import React, { useRef } from "react";
import { useContext } from "react";
import { useEffect } from "react";
import { useState } from "react";
import { ContainerInput } from "../../../styles/routes/produto/ProdutoStyle";
import { Input, Div, Span} from "../../../styles/ui/uis";
import { ComentarioContext, ComentarioProdutoWithLoading } from "./SectionComments";
import { AiOutlineStar, AiFillStar } from 'react-icons/ai';
import { useAuth } from "../../../hook/useAuth";
import { useLocation } from "react-router-dom";
import Swal from "sweetalert2";

const dominio = process.env.API_KEY;

export function InputMsg({submit}){
    const [value, setValue] = useState('');
    const [click, setClick] = useState(1);
    const [comentarios, setComentarios] = useState([])
    const [loading, setLoading] = useState(false)

    const location = useLocation();

    const params = window.location.search;
    const query = new URLSearchParams(params);
    let type = query.get("type")

    const input = useRef();
    const span = useRef();

    const {user} = useAuth();
 
    const [,setComentario] = useContext(ComentarioContext);
    const stars = [1,2,3,4,5];
   
   

    function handleInput(e){
        let ValueInput = e.target.value

        if(ValueInput.length >= 1400){
            ValueInput = value + "";
            input.current.classList.add("input-error")
            span.current.classList.add("span-error")
        }else{
            input.current.classList.remove("input-error")
            span.current.classList.remove("span-error")
        }
        setValue(ValueInput)
    }

    function submitMessage(e){ 

        let link;

        if(user == null || Object.keys(user) == 0){
            Swal.fire({
                title: "Ops!",
                text: "Você não esta logado",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }

       

        setLoading(true)
        setMessage(click, value) 
        .then(data => {
            console.log(data)
            setLoading(false)
        })       

    }
   
 

    async function setMessage(click, value){
        const path = window.location.pathname.split("/");
        const cod_user = localStorage.getItem("cod_user");

        let link;
        
        let obj = {
            stars: click,
            message: value,
            cod_user: cod_user,
        }

        switch(type){
            case "produto":
                link = "/StarPet/backend/products/messages/add"
                obj.cod_produto = path[4]
            break;

            case "pet":
                link = "/StarPet/backend/products/messages/pet/add"
                obj.cod_pet = path[4]
            break;
        }

        try {
            const request = await fetch(dominio+link, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                  },
                body: JSON.stringify(obj),
            })
            const response = await request.json()

            return response;
        } catch (error) {
            console.log(error)
            setLoading(false)
        }
    }

    function setStars(index){
        setClick(index)
    }



    return(
       <>
        <ComentarioProdutoWithLoading comentario={comentarios} 
                                        isloading={loading}/>
        <ContainerInput>
            <Div className="stars-group">
                {stars.map((e, i)=>{
                    let index = e;
                    if(i < click ){
                        return <AiFillStar size={25} color="#ffff00" key={i} onClick={()=> setStars(index)} />
                    }
                    return <AiOutlineStar size={25} key={i} onClick={()=>setStars(index)} />
                })}
            </Div>
            <Div className="input-group">
                <Input onChange={handleInput} value={value} ref={input} id="input-msg" />
                <Input type={"button"} value={"ENVIAR"} onClick={submitMessage}/>
            </Div>
            <Span ref={span}>Valor maximo atingido</Span>
        </ContainerInput>
       
       </>
    )
}