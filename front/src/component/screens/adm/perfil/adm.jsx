import React from "react";
import { useEffect } from "react";
import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { withLoading } from "../../../../HOC/withLoading";
import { StyleAdmData } from "../../../../styles/routes/perfil/PerfilAdmStyles";
import { Label } from "../../../../styles/ui/form";
import { Button, Div, Input } from "../../../../styles/ui/uis";

const dominio = process.env.API_KEY;

function Profile({nome, email}){
    const navigate  = useNavigate();

    function disconected(){
        localStorage.removeItem("cod_adm")
        navigate("/adm");
    }

    return(
        <StyleAdmData className="container-adm-data">
            <Div className="input-group">
                <Label htmlFor="adm-email">EMAIL</Label>
                <Input type={"text"} id="adm-email" value={email} disabled/>
            </Div>
            <Button onClick={disconected}>DESCONECTAR</Button>
        </StyleAdmData>
    )
}

const ProfileWithLoading = withLoading(Profile)

export function AdmDatasWithLoading(){
    const [data, setData] = useState({nome: "", email: ""});
    const [loading, setLoading] = useState(false)

    useEffect(()=>{
        setLoading(true)
        fetchAdm()
        .then(adm => {
            setLoading(false)
            setData({nome: adm.nome, email: adm.email})
        })
        .catch(error => {
            setLoading(false)
            console.log(error)
        })

        return ()=>{setData({})}
    }, [])

    async function fetchAdm(){
        const cod = localStorage.getItem("cod_adm");
        setLoading(true)
        try {
            const request = await fetch(dominio+`/StarPet/backend/users?id=${cod}`);
            const response = await request.json();
            return response[0];
        } catch (error) {
            throw new Error(error);
        }
    }

    return(
        <ProfileWithLoading nome={data.nome} email={data.email} isloading={loading}/>
    )
}