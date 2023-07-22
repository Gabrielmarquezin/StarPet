import React, { useState } from "react";
import { AiOutlineStar, AiFillStar } from 'react-icons/ai';
import { BoxComments, ContainerComment, ContainerMaster, ContainerStar, SectionComments } from "../../../styles/routes/produto/ProdutoStyle";
import { P } from "../../../styles/ui/uis";
import { Image } from "../../../styles/ui/uis";
import i from  "../../../assets/2.jpg";
import { InputMsg } from "./Input";
import {Arrow} from "./arrow";
import styles from "../../../styles/routes/produto/styles.module.css"
import { withLoading } from "../../../HOC/withLoading";
import { useEffect } from "react";
import { createContext } from "react";
import { ErrorData } from "../../error/EmptyDataError";
import { useAuth } from "../../../hook/useAuth";
import { useRef } from "react";
import { useAsyncError, useLocation } from "react-router-dom";

const dominio = process.env.API_KEY;

function Comments({data}){
     const stars = [1,2,3,4,5];
     const img = useRef()
     const {user} = useAuth()

     function errorImage(){
        img.current.src = user.photoURL;
     }

     return(
        <ContainerComment>
        <Image src={data.usuario.photo} onError={errorImage} ref={img}/>
            <P>{data.usuario.email}</P>
            <ContainerStar>
                {stars.map((e, i) =>{
                    if(i < data.stars){  
                        return <AiFillStar color="#ffff00" key={i} />
                    }else{
                        return <AiOutlineStar key={i} />
                    }
                })}
            </ContainerStar>
            <BoxComments>
                <P>{data.mensagem}</P>
            </BoxComments>
        </ContainerComment>
     )

}

const CommentsWithLoading = withLoading(Comments);


export const ComentarioContext = createContext('');

export function ContainerSectionComentario(){
    const [loading, setLoading] = useState(false);
    const [comentario, setComentario] = useState([])

    useEffect(()=>{
        setLoading(true)
        fetchData().then(data => {
            setComentario(data)
            setLoading(false)
        })

        return ()=>setComentario([])
    }, [])


    // socket.onmessage = function(event) {
    //     let response = JSON.parse(JSON.parse(event.data));
    //     setComentario(response)
    //   };


    async function fetchData(){
        const id = window.location.pathname.split("/");
        
        try{
            const request = await fetch(dominio+`/StarPet/backend/products/messages?produto=${id[4]}`);
            let produto = await request.json();
            
            if(produto == "nenhum usuario comentou"){
                produto = [];
            }        
            return produto;
        }catch(error){
            console.log(error)
        }
    }
    
    function submitMessage(){
        const msg = document.getElementById("input-msg");
       
    }

    return(
        <>
        <SectionComentaios comentario={comentario} 
                           setComentario={setComentario}
                           isloading={loading}
        />

        </>
    )
}

export function SectionComentaios({comentario, setComentario, isloading, socket}){

    return(
       <ComentarioContext.Provider value={[comentario, setComentario]}>
            <SectionComments>
                    <P className="ui-p-title">OPNIÕES DO PRODUTO</P>

                    {comentario.length !== 0
                        ? <>
                            <ContainerMaster  className={styles.ui_section_comment}>
                               {comentario.map((e, i)=>(
                                     <CommentsWithLoading isloading={isloading} data={e} key={i}/>
                               ))}
                            </ContainerMaster>
                            <Arrow />
                          </>
                        : <ErrorData message={"nenhum comentario"} />
                    }
            </SectionComments>
       </ComentarioContext.Provider>
    )
}


//tentativa

function ComentarioProduto(){
    const [comentario, setComentario] = useState([])

    const location = useLocation();

    const params = window.location.search;
    const query = new URLSearchParams(params);
    let type = query.get("type")

    useEffect(()=>{
        const id = location.pathname.split('/')
        
        let link;
        switch(type){
            case "produto":
                link = `/StarPet/backend/products/messages?produto=${id[4]}`;
            break;

            case "pet":
                link = `/StarPet/backend/products/messages/pet?produto=${id[4]}`;
            break;
        }

        fetch(dominio+link)
        .then(response => response.json())
        .then(data => {
            if(data == "nenhum usuario comentou"){
                setComentario([])
                return;
            }
            setComentario(data)
        })
        .catch(error => {
            console.log(error)
        })
    }, [])


    return(
        <SectionComments>
                    <P className="ui-p-title">OPNIÕES DO PRODUTO</P>

                    {comentario.length !== 0
                        ? <>
                            <ContainerMaster  className={styles.ui_section_comment}>
                               {comentario.map((e, i)=>(
                                     <CommentsWithLoading data={e} key={i}/>
                               ))}
                            </ContainerMaster>
                            <Arrow />
                          </>
                        : <ErrorData message={"nenhum comentario"} />
                    }
        </SectionComments>
    )
}

export const ComentarioProdutoWithLoading = withLoading(ComentarioProduto)