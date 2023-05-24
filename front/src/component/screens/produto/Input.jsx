import React, { useRef } from "react";
import { useContext } from "react";
import { useEffect } from "react";
import { useState } from "react";
import { ContainerInput } from "../../../styles/routes/produto/ProdutoStyle";
import { Input, Div, Span} from "../../../styles/ui/uis";
import { ComentarioContext } from "./SectionComments";
import { AiOutlineStar, AiFillStar } from 'react-icons/ai';

export function InputMsg({socket}){
    const [value, setValue] = useState('');
    const [click, setClick] = useState(1);

    const input = useRef();
    const span = useRef();
 
    const [,setComentario] = useContext(ComentarioContext);
    const stars = [1,2,3,4,5];
   
    useEffect(()=>{
        socket.onopen = ()=>{
            console.log("conexao aberta")
        }

        socket.onmessage = function(event) {

          let response = JSON.parse(JSON.parse(event.data));
          setComentario(response)
        };

        return () => {
            return socket.onclose = ()=>{
                    console.log('Conexão fechada');
                 };
        }
    }, [])

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
    
        const path = window.location.pathname.split("/");
        const cod_user = localStorage.getItem("cod_user");

        if(value !== ""){     
            socket.send(JSON.stringify({
                stars: click,
                message: value,
                cod_user: 5,
                cod_produto: path[4]
            }));
        }
    }

    function setStars(index){
        setClick(index)
    }

    return(
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
                <Input onChange={handleInput} value={value} ref={input}/>
                <Input type={"button"} value={"ENVIAR"} onClick={submitMessage}/>
            </Div>
            <Span ref={span}>Valor maximo atingido</Span>
        </ContainerInput>
    )
}