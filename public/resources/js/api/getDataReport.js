import { BASEURL } from "../utility/variabel.js";
import { 
    getDataReport, getTotalDataFromReport, getDetailLaporan,getFotoFromReport
} from "../utility/apiData.js";

import { showAlertError, showAlertSuccess } from "../utility/alert.js";

let offset = 0;
const loading = document.getElementById("loading");
let container = document.getElementById("laporan-container");
const modalBody = document.getElementById("body-modal");
console.log(modalBody);


function hilangkanElemenPesan(){
    document.getElementById("pesan").innerText = "";
}
async function getData(){
    try{
        loading.style.display = "inline-block";
        let totalData = await getTotalDataFromReport(BASEURL);
        console.log(totalData.total);
        if(offset >= totalData.total){
            document.getElementById("pesan").innerText = "Sudah mencapai batas!!";
            setTimeout(function(){
                hilangkanElemenPesan();
            }, 1500);
            loading.style.display = "none";
            return;
        }
        let response = await getDataReport(BASEURL, offset);
        let arrayData = response.data;

        arrayData.map((data) =>{
            container.innerHTML += ` <div class="col-12 col-md-10">
                    <div class="card py-2 px-3 border-0">
                        <div class="card-body">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12 col-md-12 col-xl-10">
                                    <div class="d-flex flex-column">
                                        <h5 class="card-title" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <p"
                                                class="text-decoration-none text-dark laporan" data-id=${data.id} style="cursor:pointer;">${data.kategori}</p>
                                        </h5>
                                        <div class="mb-2">${data.isi_laporan}</div>
                                        <small>Dilaporkan oleh ${data.nama_lengkap}</small>
                                    </div>
                                </div>
                                <div class="col-5 col-md-5 col-xl-2">
                                    <div class="d-flex flex-column">
                                        <small>${data.created_at}</small>
                                        <span class="badge text-bg-primary w-sm-25 w-md-25 w-lg-25 mt-2">${data.status}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
        });
        offset += 10;
        console.log("offset di get data ",offset )
        loading.style.display = "none";
    }catch(error){
        document.getElementById("pesan").innerText = error;
        setTimeout(function(){
            hilangkanElemenPesan();
        }, 1500);
        loading.style.display = "none";
    }
}

async function showDetailData(e){
    const target = e.target;
    if(target.classList.contains("laporan")){
        try{
            let id = target.dataset.id;
            let data = await getDetailLaporan(BASEURL, id);
            modalBody.innerHTML = data;
           
        }catch(error){
            showAlertError("Gagal mengambil data dari API !!!" + error);
        }
    }
    
}

async function showFotoFromReport(e){
    console.log(e.target);
    if(e.target.classList.contains("modal-foto")){
        try{
            const data = await getFotoFromReport(BASEURL, e.target.dataset.id);
            const src = data.foto;
            document.getElementById("foto-detail").src = "/storage/images-report/"+src.foto;
        }catch(error){
            showAlertError(error);
        }
        e.stopPropagation();
    }
}

async function loadData(){
    getData();
}


const tekan = document.getElementById("tekan");
tekan.addEventListener("click", loadData);
container.addEventListener("click", showDetailData);
modalBody.addEventListener("click", showFotoFromReport);

getData();