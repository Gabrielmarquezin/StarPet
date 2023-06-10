import React, { Component } from "react";
import { useEffect } from "react";
import { useState } from "react";
import { Loading } from "../styles/loading";

export function withLoading(Component){
    return function withLoadingComponent(props){
        const [showLoading, setShowloading] = useState(props.isloading);
       
        useEffect(()=>{
            setShowloading(props.isloading)
        }, [props.isloading])

        function toggleLoading(bool){
            console.log(bool)
            setShowloading(bool)
        }

        return (
            <>
                {showLoading ? <Loading className="loading"/> : <Component setLoading={toggleLoading} {...props} />}
            </>
        )
    }
}