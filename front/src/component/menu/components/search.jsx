import React from "react";
import { Input, Li, StyledLink } from "../../../styles/menu/menu_styles";
import styles from "../../../styles/menu/styles.module.css";
import { CiSearch } from "react-icons/ci";
import { useState } from "react";
import { useEffect } from "react";
import { getProducts } from "../../../functions/FetchProdutos";
import { useRef } from "react";
import { useMemo } from "react";
import { useNavigate } from "react-router-dom";

const dominio = process.env.API_KEY;

export function Search(){

    const [list, setList] = useState([""])
    const [toggle, setToggle] = useState(false);
    const [produtos, setProdutos] = useState([]);

    const list_dom = useRef();
    const navigate = useNavigate();

    const input = useRef();

    useEffect(()=>{
        getProducts("pet").then(data => {
            if(data.length == 0){
                setProdutos([""])
                return;
            }
            const p = data.map(d => d.nome);
            setProdutos(p)
        })
    }, []);

    const handleSearch = useMemo(()=>{
        let lista_names = produtos
        .filter(p => p.toLowerCase().includes(list.toLowerCase()))
        
        return lista_names;
    }, [list])

    function changeSearch(e){
        setList(e.target.value)

        if(e.key == "Enter"){
            navigate(`/home/search?name=${e.target.value}`)
        }
    }

    function ListSearch(e){
      let value = e.target.firstChild.innerHTML
      
      input.current.value = value;
      navigate(`/home/search?name=${value}`)
    }

    return(
        <div className={styles.container_all}>
            <div className={styles.search_container}>
                <Input type={"text"} onFocus={()=> setToggle(true)} onBlur={()=> setToggle(false)} onKeyUp={changeSearch} ref={input}/>
                <CiSearch id={styles.icon_search}/>
            </div>
            <div className={styles.list_sugestion+" "+`${!toggle && styles.list_toggle}`} ref={list_dom}>
                {handleSearch.map((lista, i)=>(
                    <Li key={i} onClick={ListSearch} ><StyledLink style={{color: "#000000"}} key={i}>{lista}</StyledLink></Li>
                ))}
            </div>
        </div>
    )
}