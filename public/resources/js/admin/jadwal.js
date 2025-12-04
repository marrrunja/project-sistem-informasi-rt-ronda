import {
    BASEURL,
    TOKEN
} from "../utility/variabel.js";
import {
    tambahJadwal
} from "../utility/apiData.js";
import { showAlertError, showAlertSuccess, showMessage } from "../utility/alert.js";
const container = document.getElementById("container-jadwal");

let card = null;



async function jadwal(e) {
    if (e.target.classList.contains("btn-jadwal-add")) {
        if (card != null) return;
        card = document.createElement("div");
        card.classList.add("col-12");
        card.classList.add("col-md-8");
        card.classList.add("col-xl-4");
        let elementCard = `
    <div class="card border shadow-0">
    <div class="card-body">
        <div class="d-flex gap-3 justify-content-between">
            <input type="date" id="tanggal" class="form-control" name="tanggal">
            <button class="btn btn-success btn-add">
                Tambah
            </button>
        </div>
    </div>
    </div>`;
        card.innerHTML = elementCard;
        container.appendChild(card);

    }
    if (e.target.classList.contains("btn-add")) {
        const tanggal = document.getElementById("tanggal").value;
        if(tanggal == "" || tanggal == null){
            showAlertError("Tanggal tidak boleh kosong!!");
            return;
        }
        try{
            let response = await tambahJadwal(BASEURL, TOKEN, tanggal);
            if(response.status === "Berhasil"){
                showMessage(response.message, response.icon, response.status);
                setTimeout(function(){
                    document.location.reload(false);
                }, 1500)
                card.remove();
                card = null;
            }
            showMessage(response.message, response.icon, response.status);
        }catch(error){
            showAlertError(error);
        }
    }
}

container.addEventListener("click", jadwal);
