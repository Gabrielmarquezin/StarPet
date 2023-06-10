export async function GetFile(file){
    var byteCharacters = atob(file);
    var byteArrays = [];
    for (var offset = 0; offset < byteCharacters.length; offset += 1024) {
      var slice = byteCharacters.slice(offset, offset + 1024);
      
      var byteNumbers = new Array(slice.length);
      for (var i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }
      
      var byteArray = new Uint8Array(byteNumbers);
      byteArrays.push(byteArray);
    }
    
    var blob = new Blob(byteArrays, { type: 'image/jpeg' });

    return blob;
}