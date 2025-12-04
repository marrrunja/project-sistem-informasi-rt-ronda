import { showConfirm } from "../utility/alert.js";

const formNonaktif = document.getElementById("form-nonaktif");
const formHapus = document.getElementsByClassName("form-hapus");




async function nonaktif(e) {
    e.preventDefault();
    await showConfirm("Anda yakin ingin menonaktifkan jadwal?", "warning", "Iya").then(async (result) => {
        if (result.isConfirmed) {
           formNonaktif.submit();
        }
    });
}
async function aktifkan(e) {
    e.preventDefault();
    await showConfirm("Anda yakin ingin mengaktifkan jadwal?", "question", "Iya").then(async (result) => {
        if (result.isConfirmed) {
           formNonaktif.submit();
        }
    });
}


for(let i = 0; i < formHapus.length; i++){
    formHapus[i].addEventListener("submit", async function(e){
        e.preventDefault();
        await showConfirm("Anda yakin ingin menghapus warga dari jadwal ronda?", "question", "Iya").then(async (result) => {
            if (result.isConfirmed) {
            formHapus[i].submit();
            }
        });
    });
}

async function deleteJadwal(e){
    if(e.target.classList.contains("btn-hapus")){
        e.target.preventDefault();
    }
}



if(formNonaktif.dataset.aktif === 1){
    formNonaktif.addEventListener("submit", nonaktif);
}
else {
    formNonaktif.addEventListener("submit", aktifkan);
}