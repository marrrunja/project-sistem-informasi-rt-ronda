import { BASEURL, TOKEN } from "./utility/variabel.js";
import { showAlertError, showAlertSuccess } from "./utility/alert.js";
const formRegister = document.getElementById("formRegister");




async function register(username, nama, passsword, password2)
{
    const data = {
        username : username.value,
        nama_lengkap: nama.value,
        passsword:passsword.value,
        password2:password2.value
    };


    const response = await fetch(BASEURL + "/register", {
        method:"POST",
        headers:{
            "Content-Type":"Application/json",
            "X-CSRF-TOKEN": TOKEN
        },
        body:JSON.stringify(data)
    });

    if(!response.ok){
        throw new Error("Error" + response.status);
    }
    const responseUrl = await response.json();
    console.log(responseUrl.message);
    console.log(responseUrl.data);

}

async function handleSubmit(e)
{
    e.preventDefault();
   
    const username = document.getElementById("username");
    const namaLengkap = document.getElementById("nama");
    const password = document.getElementById("password");
    const password2 = document.getElementById("password2");
    console.log(username);
    
    try{
        await register(username, namaLengkap, password, password2);
        console.log("Ok");

    }catch(error){
        showAlertError("ERROR" + error);
    }
    
}

formRegister.addEventListener("submit", handleSubmit);