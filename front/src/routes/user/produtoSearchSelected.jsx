import { async } from "@firebase/util";
import React from "react";
import { useState } from "react";
import { useEffect } from "react";
import { useLocation } from "react-router-dom";
import { ErrorData } from "../../component/error/EmptyDataError";
import { PetWithLoading } from "./Pet";
import { ProdutoWithLoading } from "./Produto";

const dominio = process.env.API_KEY;

export function ProdutoSelectedSearch(){
    const [data, setData] = useState("");
    const [loading, setLoading] = useState(false);

    const location = useLocation();
    const params = new URLSearchParams(location.search);
    const type = params.get("type")

    if(type == "pet"){
        return <PetWithLoading />
    }
    if(type == "produto"){
        return <ProdutoWithLoading />
    }
}