import React, { Component } from "react";
import { useState } from "react";
import { Loading } from "../styles/loading";

export function withLoading(Component){
    return function withLoadingComponent({isloading}){
        const [showLoading, setShowloading] = useState(isloading)

        if(showLoading){
            return <Loading />
        }

        return <Component setLoading={setShowloading} />
    }
}