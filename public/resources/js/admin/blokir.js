import {
    BASEURL,
    TOKEN
} from "../utility/variabel.js";
import {
    blokirUser,
    bukaBlokir
} from "../utility/apiData.js";
import {
    showAlertError,
    showConfirm,
    showMessage
} from "../utility/alert.js";

const buttons = document.getElementsByClassName("btn-blokir");

function afterBlokir(i) {
    buttons[i].classList.remove("btn-outline-danger");
    buttons[i].classList.add("btn-outline-primary");
    buttons[i].dataset.status = "0";
    buttons[i].parentElement.parentElement.classList.remove("fw-bolder");
    buttons[i].innerText = "Aktifkan";
    buttons[i].parentElement.previousElementSibling.innerText = "Tidak aktif";
}

function afterBukaBlokir(i){
    buttons[i].classList.remove("btn-outline-primary");
    buttons[i].classList.add("btn-outline-danger");
    buttons[i].dataset.status = "1";
    buttons[i].parentElement.parentElement.classList.add("fw-bolder");
    buttons[i].innerText = "Nonaktifkan";
    buttons[i].parentElement.previousElementSibling.innerText = "Aktif";
}


for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", async function () {

        if (buttons[i].dataset.status == "1") {
            showConfirm("Apakah anda yakin ingin memblokir akun ini?", "warning", "Blokir").then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await blokirUser(BASEURL, buttons[i].dataset.id, TOKEN);
                        if (response.status == "Berhasil") {
                            showMessage(response.message, response.icon, response.status);
                            afterBlokir(i);
                        }
                    } catch (error) {
                        showAlertError(error);
                    }
                }
            });;
        }
        else if(buttons[i].dataset.status == "0"){
            try{
                const response = await bukaBlokir(BASEURL, buttons[i].dataset.id, TOKEN);
                if(response.status == "Berhasil"){
                    showMessage(response.message, response.icon, response.status);
                    afterBukaBlokir(i);
                }
            }catch(error){
                showAlertError(error);
            }
        }
    });
}
