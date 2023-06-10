import React from "react";
import {InputPerfil } from "../../../form/components/inputFile";
import { MenuAdm } from "../../../menu/menu-v/myPerfil/MenuPerfil";
import NoImage from "../../../../assets/noimage.png";
import { SectionMenu } from "../../../../styles/routes/perfil/PerfilStyles";
import { FooterMin } from "../../../footer/footer";
import { useEffect } from "react";
import Swal from "sweetalert2";

const dominio = process.env.API_KEY;

export function PerfilAdm({src}){

    useEffect(()=>{
        const btnEdit = document.getElementById("btn-edit");
        btnEdit.disabled = true;
    }, [])

    function Cancel(){
        const btnEdit = document.getElementById("btn-edit");
        btnEdit.disabled = false;

        const img = document.getElementById("ui-img-adm");
        img.src = "data:image/jpeg;base64,"+src;
    }

    async function handleSubmit(e){
        const cod = localStorage.getItem("cod_adm");
        
        const InputFile = document.getElementById("file-perfil");
        const photo = InputFile.files[0];

        const formData = new FormData()
        formData.append("photo", photo)
        formData.append("bairro", "")
        formData.append("rua", "")
        formData.append("casa_numero", "")
        formData.append("cod_user", cod)

        try{
            const request = await fetch(dominio+`/StarPet/backend/users/adm/update`, {
                method: "POST",
                mode: "cors",
                body: formData
            });
            const response = await request.json();
            
            if(response.message !== "atualizado"){
                Swal.fire({
                    title: "Ops!",
                    text: response.message,
                    icon: "error",
                    confirmButtonText: "OK"
                })
                return;
            }

            Swal.fire({
                title: "Hellow",
                text: "Sua Foto foi atualizada",
                icon: "success",
                confirmButtonText: "OK"
            })
        }catch(erro){
            console.log(erro)
        }
    }
    return(
       <SectionMenu>
            <InputPerfil src={src == "" ? NoImage : src} cancel={Cancel} submit={handleSubmit} id={"ui-img-adm"}/>
            <MenuAdm />
           <FooterMin />
       </SectionMenu>
    )
}
