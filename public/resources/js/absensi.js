import {
    BASEURL,
    TOKEN
} from "./utility/variabel.js";
import {
    ubahAbsensi
} from "./utility/apiData.js";
import {
    showAlertError,
    showMessage,
    showSnackMessage
} from "./utility/alert.js";

const btnHadir = document.getElementById("btnHadir");
const btnIzin = document.getElementById("btnIzin");


async function absen(status) {
    if (status == "izin") {
        try {
            let response = await ubahAbsensi(BASEURL, TOKEN, "izin", btnIzin.dataset.id);
            showSnackMessage(response.message, response.icon);
            setTimeout(function () {
                document.location.reload(false);
            }, 1500)
        } catch (error) {
            showAlertError(error);
        }
    } else if (status == "hadir") {
        try {
            let response = await ubahAbsensi(BASEURL, TOKEN, "hadir", btnHadir.dataset.id);
            showSnackMessage(response.message, response.icon);
            setTimeout(function () {
                document.location.reload(false);
            }, 1500)
        } catch (error) {
            showAlertError(error);
        }
    }
}

async function absenIzin() {
    try {
        let response = await ubahAbsensi(BASEURL, TOKEN, "izin", btnIzin.dataset.id);
        showSnackMessage(response.message, response.icon);
        setTimeout(function () {
            document.location.reload(false);
        }, 1500)
    } catch (error) {
        showAlertError(error);
    }

}
async function absenHadir() {
    try {
        let response = await ubahAbsensi(BASEURL, TOKEN, "hadir", btnHadir.dataset.id);
        showSnackMessage(response.message, response.icon);
        setTimeout(function () {
            document.location.reload(false);
        }, 1500)
    } catch (error) {
        showAlertError(error);
    }
}

if (btnHadir != null || btnIzin != null) {
    btnHadir.addEventListener("click", absenHadir);
    btnIzin.addEventListener("click", absenIzin);
}
