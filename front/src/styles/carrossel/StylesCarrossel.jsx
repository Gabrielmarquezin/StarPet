import { styled } from "styled-components";

export const Imagem = styled.img.attrs((props) => ({
    src: props.src,
    alt: props.alt,
}))`
    width: 30%;
    height: 100%;
    object-fit: cover;
    scroll-snap-align: start;
    flex: none;
`;

export const ContainerCarrossel = styled.div`
    display: flex;
    align-items: center;
    overflow: hidden;
    gap: 10px;
    width: ${props => props.widthcarrossel};
    height: ${props => props.heightcarrossel};
    padding: 10px 15px;
`;
ContainerCarrossel.defaultProps = {
    widthcarrossel: "100%"
}

export const CarrosselImage = styled.div`
    height: 100%;
    width: 100%;
    display: flex;
    overflow: hidden;
    overflow: scroll;
    overflow-x: hidden;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    gap: 10px;
`;


export const BoxCarrossel = styled.div`
    overflow: hidden;
    width: 100%;
    height: 100%;
`

