import React, { useRef } from "react";
import { Input } from "../../../styles/menu/menu_styles";
import { StyleFile } from "../../../styles/routes/perfil/PerfilStyles";
import { Label } from "../../../styles/ui/form";
import { Button, Div, Image, Span, Input as InputUi} from "../../../styles/ui/uis";
import NoImage from "../../../assets/noimage.png";
import { useState } from "react";
import { Loading2Version } from "../../screens/loading/loading";

export function InputFile({name, src}){

    const span = useRef();

    function changeFile(e){
        const input = e.target;
        const file = input.files[0]

        if(file){
            const reader = new FileReader();

            reader.addEventListener('load', (e)=>{
                const readerTarget = e.target;

                const img = document.createElement('img')
                img.src = readerTarget.result
                img.classList.add('picture')

                span.current.innerHTML = ""
                span.current.appendChild(img)
            })

            reader.readAsDataURL(file)
        }
    }

    return(
        <Div className="input-file">
            <Label htmlFor="file">
                <Span ref={span}>Choose a image</Span>
            </Label>
            <InputUi type={"file"} style={{"display": "none"}} id="file" onChange={changeFile} name={name} />
        </Div>
    )
}

export function InputPerfil({src, name, cancel, submit, id}){
    
    const [load, setLoad] = useState(true)
    const Img = useRef();
    const InputFile = useRef();
    
    function changeFile(e){
        const input = e.target;
        const file = input.files[0]
        const btnEdit = document.getElementById('btn-edit');

        setLoad(true)
        if(file){
            btnEdit.disabled = false;
            const reader = new FileReader();

            reader.addEventListener('load', (e)=>{
                const readerTarget = e.target;

                Img.current.src = ""
                Img.current.src = readerTarget.result
            })

            reader.readAsDataURL(file)
        }else{
            Img.current.src = DataUser.photo
            btnEdit.disabled = true;
        }
        setLoad(false)
    }

    function loadImage(){
        setLoad(false)
    }

    return(
       <StyleFile>
            <Label htmlFor="file-perfil">
                <Span className="ui-span" >
                    <Image src={"data:image/jpeg;base64,"+src} alt="imagem" ref={Img} id={id} onError={()=>Img.current.src = NoImage} onLoad={loadImage}/>
                    {load && <Loading2Version /> }
                </Span>
            </Label>
            <Input type={"file"} id="file-perfil" onChange={changeFile} ref={InputFile} name={name}/>
            <Div className="button-group">
                <Button type={"button"} onClick={submit} id="btn-edit">EDITAR</Button>
                <Button type={"button"} onClick={cancel}>CANCELAR</Button>
            </Div>
       </StyleFile>
    )

}