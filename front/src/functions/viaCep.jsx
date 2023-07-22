export async function ViaCep(cep){
    try {
        const request = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const response = await request.json();

        return response;
    } catch (error) {
        console.log(error)
    }
}