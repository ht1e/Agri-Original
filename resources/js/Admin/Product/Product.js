const $ = document.querySelector.bind(document);

console.log($('#imgProduct'));


window.displayImage = (input) =>{
    if(input.files && input.files[0]) {
        var reader = new FileReader()

        reader.onload = (e) => {
             $('#imgProduct').setAttribute('src', e.target.result)
        }

        reader.readAsDataURL(input.files[0])
    }
}