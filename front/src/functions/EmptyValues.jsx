export function SubstituirValues(array, substituto){

    let arr = array.map(([key, value])=>{
        if(value == ""){
           value = substituto;
        }
        return [key, value];
    })

    const objeto = {};

    arr.forEach(([chave, valor]) => {
        objeto[chave] = valor;
    });

    return objeto;
}