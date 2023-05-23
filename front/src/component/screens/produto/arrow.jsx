import React from "react";
import { useEffect } from "react";
import { useRef } from "react";
import { useState } from "react";
import { IoIosArrowUp } from 'react-icons/io';
import styles from "../../../styles/routes/produto/styles.module.css"

export function Arrow(){
    const iconRef = useRef();
    const [change, setChange] = useState(true)
  
    function handleResizer(){
        const windowHeight = (window.innerHeight)*0.89;
        const sectionHeight = document.getElementById("section-comment").clientHeight;
        
        if(windowHeight <= sectionHeight){
            iconRef.current.classList.add(styles.arrow_unactive)
        }else{
            iconRef.current.classList.remove(styles.arrow_unactive)
        }
    }

    function downSectionew(e){
        const section =  document.getElementById("section-comment")
        section.classList.toggle(styles.down_section_height)
        setChange((prev) => !prev)
    }

    useEffect(()=>{
        const section = document.getElementById("section-comment")
        const resizeObserver = new ResizeObserver(entries => {
            for (let entry of entries) {
              handleResizer()
            }
          });
          
        resizeObserver.observe(section);

        return ()=> resizeObserver.unobserve(section);
    }, [])


    return(
        <>
        <div className={styles.arrow}  ref={iconRef}>
           {change 
                ?  <IoIosArrowUp style={{rotate: "180deg"}}  onClick={downSectionew} size={25} color="#0000fff2"/>
                :  <IoIosArrowUp onClick={downSectionew} size={25} color="#0000fff2"/>
            }
        </div>
        </>
    )
}