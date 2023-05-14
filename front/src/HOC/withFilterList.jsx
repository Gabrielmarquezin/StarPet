import React, { useState } from "react";
import { OtherFilterList } from "../component/menu/filter/FilterMenu";

export function withFilterList(Component){
    return function withFilterListComponent(){
        const [showFilter, setShowFilter] = useState(false)

        function activefilter(){
            setShowFilter(true)
        }

        function desactivefilter(){
            setShowFilter(false)
        }

        return(
            <>
                 <Component activefilter={activefilter} desactivefilter={desactivefilter}>
                    {showFilter ? <OtherFilterList /> : ""}
                 </Component>
                 
            </>
        )
    }
}