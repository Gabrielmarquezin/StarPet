import { useRef } from "react";
import { Label } from "../../../../styles/ui/form";
import { Div, Input, Span } from "../../../../styles/ui/uis";

export function InputFile(){

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
            <Input type={"file"} style={{"display": "none"}} id="file" onChange={changeFile}/>
        </Div>
    )
}