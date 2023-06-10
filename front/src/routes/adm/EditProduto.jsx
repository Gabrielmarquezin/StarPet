import React, { useEffect } from "react";
import { useRef } from "react";
import { createContext } from "react";
import { useState } from "react";
import Swal from "sweetalert2";
import { ErrorData } from "../../component/error/EmptyDataError";
import { ContainerForm } from "../../component/form/ProdutoForm/ProdutoUpdate/form";
import { PerfilAdm } from "../../component/screens/adm/perfil/perfil";
import { MainHome } from "../../styles/routes/home/HomeStylesAdm";
import { Section } from "../../styles/routes/produto/editProdutoStyle";
import { Label, Option, Select } from "../../styles/ui/form";
import { Button, Div, Hr, Input, P, Span } from "../../styles/ui/uis";

const dominio = process.env.API_KEY;
const cod_adm = localStorage.getItem("cod_adm");

export const ProdutoContext = createContext('');
export function EditProduto(){
    const [produto, setProduto] = useState({});
    const [src, setSrc] = useState("");
    const [route, setRoute] = useState("");

    const inputValue = useRef();
    const span = useRef();
    const btn = useRef();

    if(!cod_adm){
        return <ErrorData message="Adm nao logado, por favor faça seu login" />
    }

    useEffect(()=>{
        setRoute("produto")
    }, [])
    
    useEffect(()=>{
        if(cod_adm){ 
            getAdm(cod_adm).then(data =>{
                setSrc(data[0].photo)
            })
        }
    }, [cod_adm])

    async function getAdm(cod){
        try {
            const request = await fetch(dominio+`/StarPet/backend/users?cod=${cod}`)
            const response = await request.json();

           return response;
        } catch (error) {
            console.log(error)
        }
    }

    async function handleForm(e){
    
        const cod = inputValue.current.value;
        
        if(typeof parseInt(cod) != "number"){
            Swal.fire({
                title: "Error",
                text: "insira um codigo valido",
                icon: "error",
                confirmButtonText: "OK"
            })

            return;
        }
        
        if(cod == ""){
            inputValue.current.classList.add("error-input")
            span.current.classList.add("error-span")

            return;
        }else{
            inputValue.current.classList.remove("error-input")
            span.current.classList.remove("error-span")
        }
        
        btn.current.disabled = true;

        const data = await fetchProduto(cod);

        if(data.length > 1 || data.message){
            btn.current.disabled = false;
            Swal.fire({
                title: "Error",
                text: "produto nao existe",
                icon: "error",
                confirmButtonText: "OK"
            })
            return;
        }

        setProduto(data[0]);

        btn.current.disabled = false;

        const container = document.querySelector(".ui-container-product");
        container.style.transform = "translateX(calc(-100% + 20px)";
    }

    async function fetchProduto(cod){
        let link = "";

        switch(route){
            case "produto":
                link = `/StarPet/backend/products?id=${cod}`
                break;
            case "pet":
                link = `/StarPet/backend/products/pet?id=${cod}`
                break;
            case "pet_adocao":
                link = `/StarPet/backend/products/pet/adocao?id=${cod}`
            break;

            default:
                link = `/StarPet/backend/products?id=${cod}`
        }

        try {
            const request = await fetch(dominio+link)
            const response = await request.json();

            return response;
           } catch (error) {
            console.log(error)
           }
    }

    function handleSelect(e){
        setRoute(e.target.value)
    }

    return(
        <ProdutoContext.Provider value={{produto: produto, route: route}}>
            <MainHome>
                <PerfilAdm src={src}/>
                <Section>
                    <Div className="ui-container-product">
                        <Div className="ui-container-codigo">
                            <Div className="box">
                                <Select onChange={handleSelect}>
                                    <Option value={"produto"}>Produto</Option>
                                    <Option value={"pet"}>Pet</Option>
                                    <Option value={"pet_adocao"}>Pet Adoção</Option>
                                </Select>

                                <Input type={"text"} placeholder="Digite o codigo do produto" ref={inputValue}/>
                                <Span ref={span}>Codigo obrigatorio</Span>
                            </Div>
                            <Button type="button" onClick={handleForm} ref={btn}>PROXIMO</Button>
                        </Div>
                        <ContainerForm />
                    </Div>
                </Section>
            </MainHome>
        </ProdutoContext.Provider>
    )
};