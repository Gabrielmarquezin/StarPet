import React from "react";
import { Footer } from "../../component/footer/footer";
import { Div, P } from "../../styles/ui/uis";

export function PoliticaPrivacidade(){
    return(
        <>
               <Div style={{maxWidth: "80%", margin: "auto", textAlign: "-moz-initial", marginTop: "100px"}}>
            <P>
            <strong>Política de Privacidade do Pet Shop</strong><br />
            <br />

Nossa política de privacidade tem como objetivo proteger as informações pessoais dos nossos clientes. Coletamos apenas os dados necessários para fornecer nossos serviços, como nome, endereço, informações de contato e detalhes do pet. Essas informações são usadas estritamente para atender às suas solicitações, personalizar sua experiência e garantir a qualidade dos nossos serviços. <br />
<br />
<br />
Respeitamos a privacidade dos nossos clientes e não compartilhamos suas informações pessoais com terceiros, a menos que seja necessário para fornecer os serviços solicitados por você. Tomamos medidas de segurança para proteger seus dados contra acesso não autorizado, alteração, divulgação ou destruição. <br />
<br />
<br />
Nossa política de privacidade está em conformidade com as leis de proteção de dados vigentes. Ao utilizar nossos serviços, você concorda com a coleta e uso das suas informações pessoais de acordo com esta política. Estamos comprometidos em manter a confidencialidade e segurança das suas informações. Caso tenha alguma dúvida ou preocupação, entre em contato conosco.<br />

            </P>
        </Div>
        <Footer />
        
        </>
    )
}