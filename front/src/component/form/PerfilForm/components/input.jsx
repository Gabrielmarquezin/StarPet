import React, { useRef } from "react";
import { useContext } from "react";
import Swal from "sweetalert2";
import { useAuth } from "../../../../hook/useAuth";
import { PerfilContext } from "../../../../routes/user/Perfil";
import { StyleFile } from "../../../../styles/routes/perfil/PerfilStyles";
import { Label } from "../../../../styles/ui/form";
import { Button, Div, Image, Input, P, Span } from "../../../../styles/ui/uis";


const dominio = process.env.API_KEY;

export function UserPerfil(){
    const {DataUser} = useContext(PerfilContext);
    const {user} = useAuth()

    const Img = useRef();
    const InputFile = useRef();
    const btnEdit = useRef();

    function Cancel(){
        Img.current.src = "data:image/jpeg;base64,"+DataUser[0].photo;
        btnEdit.current.disabled = true;
    }

    function changeFile(e){
        const input = e.target;
        const file = input.files[0]

        if(file){
            btnEdit.current.disabled = false;
            const reader = new FileReader();

            reader.addEventListener('load', (e)=>{
                const readerTarget = e.target;

                Img.current.src = ""
                Img.current.src = readerTarget.result
            })

            reader.readAsDataURL(file)
        }else{
            Img.current.src = DataUser.photo
            btnEdit.current.disabled = true;
        }
    }

    async function submitFile(e){
       let data = DataUser[0];
       delete data.photo;

       console.log("ola")
       const formData = new FormData();
       formData.append("photo", InputFile.current.files[0])
       formData.append("bairro", data.bairro)
       formData.append("rua", data.rua)
       formData.append("casa_numero", data.casa)
       formData.append("cod_user", data.cod)

       try {
        const showLoading = () => {
            Swal.fire({
              title: 'Carregando...',
              html: 'Pode levar uns instantes',
              allowEscapeKey: false,
              allowOutsideClick: false,
              showConfirmButton: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });
          };
          
        showLoading();
        const request = await fetch(dominio+`/StarPet/backend/users/update`, {
            method: "POST",
            mode: 'cors',
            body: formData
        });
        const response = await request.json();

        Swal.close();
        Swal.fire({
            title: "Opa",
            text: "perfil atualizado",
            icon: "success",
            confirmButtonText: "OK"
        });

       } catch (error) {
        Swal.close();
        Swal.fire({
            title: "Ops",
            text: "hove algo de errado no servidor, tenete mais tarde",
            icon: "error",
            confirmButtonText: "OK"
        });
        console.log(error)
       }

    }

    function ImgError(e){
        e.target.src = user.photoURL
    }

    return(
       <StyleFile>
            <Label htmlFor="file-perfil">
                <Span className="ui-span" >
                    <Image src={"data:image/jpeg;base64,"+DataUser[0].photo} alt="imagem" ref={Img} onError={ImgError}/>
                </Span>
            </Label>
            <Input type={"file"} id="file-perfil" onChange={changeFile} ref={InputFile}/>
            <Div className="button-group">
                <Button type={"button"} onClick={submitFile} ref={btnEdit}>EDITAR</Button>
                <Button type={"button"} onClick={Cancel}>CANCELAR</Button>
            </Div>
       </StyleFile>
    )

}