import React, { Component } from "react";
import { useEffect } from "react";
import { useState } from "react";
import { Loading } from "../styles/loading";

export function withLoading(Component){
    return function withLoadingComponent({isloading, data}){
        const [showLoading, setShowloading] = useState(isloading);
       
        useEffect(()=>{
            setShowloading(isloading)
        }, [isloading])

        function toggleLoading(bool){
            setShowloading(bool)
        }

        return (
            <>
                {showLoading ? <Loading /> : <Component setLoading={toggleLoading} data={data} />}
            </>
        )
    }
}