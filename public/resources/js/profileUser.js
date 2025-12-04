import { showAlertError, showAlertSuccess, showMessage } from "./utility/alert.js";
import { getDetailUser, editData } from "./utility/apiData.js";
import { BASEURL, TOKEN } from "./utility/variabel.js";

const cardBody = document.getElementById("body-profil");
const btnUbah = document.getElementById("btn-ubah");
btnUbah.style.cursor = "pointer";
cardBody.style.transition = ".3s ease-in-out";

async function showDetailUser(){
    try{
        const data = await getDetailUser(BASEURL, btnUbah.dataset.id);
        cardBody.innerHTML = data;
    }catch(error){
        showAlertError(error);
        console.log(error);
    }
}

async function ubahData(e)
{
    if(e.target.classList.contains("btn-simpan")){
        const nama = document.getElementById("nama");
        const wa = document.getElementById("wa");
        const alamat = document.getElementById("alamat");
        const id = btnUbah.dataset.id;
        try{
            let response = await editData(BASEURL, id, nama.value, wa.value, alamat.value, TOKEN);
            showMessage(response.message, response.icon, response.status);
            setTimeout(function(){
                document.location.reload(false);
            }, 1500);
        }catch(error){
            showAlertError(error);
        }
    }
    if(e.target.classList.contains("btn-batal")){
        
    }
}

btnUbah.addEventListener("click", showDetailUser);

cardBody.addEventListener("click", ubahData);
