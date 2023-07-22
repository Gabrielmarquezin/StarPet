import React, { useState } from "react";
import { useEffect } from "react";
import { createContext } from "react";

export const ProdutoContext = createContext("");

export function ProdutoProvider({children}){
    const [data, setData] = useState();

    const updateData = (value) => {
        setData(value)
    }

    return (
        <ProdutoContext.Provider value={{data: data, updateData}}>
            {children}
        </ProdutoContext.Provider>
    )
}