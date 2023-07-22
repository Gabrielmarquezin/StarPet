const dominio = process.env.API_KEY;

export async function getProducts(type){
    let link
    switch(type){
        case "pet":
            link = dominio+"/StarPet/backend/products/pet";
            break;
            
        case "produto":
            link = dominio+"/StarPet/backend/products";
            break;
    }

    try {
        const request = await fetch(link, {
            method: "GET",
            mode: "cors"
        });
        const response = await request.json();

        return response;
    } catch (error) {
        console.log(error)
        return [{message: error}];
    }
}