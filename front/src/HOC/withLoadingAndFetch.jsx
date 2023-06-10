import React from "react";
import { useEffect } from "react";
import { useState } from "react";
import { Loading } from "../styles/loading";

export function withLoadingAndFetch(Component, fetchData){
    return function withLoadingComponent(props){
        const [loading, setLoading] = useState(true);
        const [dados, setDados] = useState(null)

        useEffect(()=>{
            fetchData().then(data => {
                setDados(data)
                setLoading(false)
            })
        }, [])

        function toggleLoading(bool){
            setLoading(bool)
        }

        return(
            <>
                {loading ? <Loading /> : <Component data={dados} setLoading={toggleLoading} />}
            </>
        )
    }
}