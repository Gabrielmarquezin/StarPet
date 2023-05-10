import { styled } from "styled-components";

export const Imagem = styled.img.attrs((props) => ({
    src: props.src,
    alt: props.alt,
}))`
    width: 30%;
    height: 100%;
    object-fit: cover;
    flex: none;
`;

export const ContainerCarrossel = styled.div`
    display: flex;
    align-items: center;
    overflow: hidden;
    gap: 10px;
    width: ${props => props.widthCarrossel};
    height: ${props => props.heightCarrossel}
`;
ContainerCarrossel.defaultProps = {
    widthCarrossel: "100%"
}

export const CarrosselImage = styled.div`
    height: 100%;
    width: 100%;
    display: flex;
    overflow: hidden;
    gap: 8px;
`;

export const BoxCarrossel = styled.div`
    overflow: hidden;
    width: 100%;
`

