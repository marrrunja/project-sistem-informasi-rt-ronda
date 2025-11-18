import { showAlertError, showAlertSuccess } from "./utility/alert.js";

const message = document.getElementById("message");

if(message != null){
    if(message.dataset.alert === 'primary')
        showAlertSuccess(message.innerText);
    else
        showAlertError(message.innerText);
}

