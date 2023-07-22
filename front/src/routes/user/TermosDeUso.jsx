import React from "react";
import { Footer } from "../../component/footer/footer";
import { Div, P } from "../../styles/ui/uis";

export function TermosDeUso(){
    return(
        <>
            <Div style={{maxWidth: "80%", margin: "auto", textAlign: "-moz-initial", marginTop: "100px"}}>
            <P>
            <strong>

Ao utilizar os serviços do nosso pet shop, você concorda com os seguintes termos:</strong>
            <br />
            <br />
            Termos de Uso do Pet Shop

Ao utilizar os serviços do nosso pet shop, você concorda com os seguintes termos:

    Responsabilidade pelo Pet: Você é responsável por garantir a saúde, segurança e bem-estar do seu pet durante sua estadia no pet shop. Nós nos comprometemos a fornecer cuidados adequados, mas não nos responsabilizamos por quaisquer danos, lesões ou doenças que possam ocorrer durante o período em que o seu pet estiver sob nossos cuidados.<br />

    Pagamentos e Cancelamentos: Os pagamentos pelos serviços prestados devem ser feitos de acordo com nossas políticas de preços e formas de pagamento. Caso precise cancelar ou reagendar um serviço, pedimos que nos informe com antecedência para podermos fazer os ajustes necessários. Reservamo-nos o direito de cobrar taxas de cancelamento em casos de cancelamentos tardios ou não comparecimento.

            </P>
        </Div>
        <Footer />
        </>
    )
}