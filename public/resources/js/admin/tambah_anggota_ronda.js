import { showAlertError, showConfirm,  showMessage, showSnackError, showSnackMessage}  from "../utility/alert.js";
import { deleteUserFromJadwal, deleteUsersFromJadwal, searchDataUser, tambahAnggotaJadwal } from "../utility/apiData.js";
import { BASEURL, TOKEN } from "../utility/variabel.js";


const listUser = document.getElementById("list-user");
const selectedUserContainer = document.getElementById("selected-user-container");
const formTambahAnggota = document.getElementById("form-tambah-anggota");
const searchUser = document.getElementById("search-user");
const btnTambahAnggota = document.getElementById("btn-tambah-anggota");
const btnHapus = document.getElementById("btn-hapus-anggota");
const containerJadwal = document.getElementById("container-jadwal");
const formHapus = document.getElementsByClassName("form-hapus");

// user yang di select (object id dan name) untuk ditambahkan lagi ke dalam container list user
const arrayListUserSelected = [];

// idUser yang diselect, agar nanti di pencarian, tidak ada user yang sama
const idUserSelected = [];

const idAbsensiDelete = [];
let deletedAbsensiId = [];
const badgeColors = [
    "bg-primary",
    "bg-secondary",
    "bg-success",
    "bg-danger",
    "bg-warning",
    "bg-info",
    "bg-dark"
];

// menambahkan user ke dalam container list user, untuk nntinya ditambahkan ke jadwal
function addUser(id, name) {

    const randomColor = badgeColors[Math.floor(Math.random() * badgeColors.length)];
    const span = document.createElement("span");


    const className = `badge ${randomColor} me-2 mb-2 py-2 px-3`;
    span.classList.add(...className.split(" "));
    span.innerHTML = `${name}
                        <button type="button" data-id=${id} data-name=${name} class="btn-close btn-close-white ms-2"
                                    style="font-size:8px;"></button>`;
    selectedUserContainer.appendChild(span);

}

// mengembalikan user yang sudah di select untuk ditambahkan ke jadwal
function restoreUser(id, name) {
    const formCheck = document.createElement("div");
    const className = "form-check py-2 border-bottom user-item";
    const html = `
            <input class="form-check-input user-check" data-id="${id}" data-name="${name}" type="checkbox" name="users[]" value="${id}"
                                id="user${id}">

            <label class="form-check-label w-100" for="user${id}" style="cursor:pointer;">
                ${name}
            </label>
    `;
    formCheck.classList.add(...className.split(" "));
    formCheck.innerHTML = html;
    listUser.appendChild(formCheck);
}


// mencari index dari array list user selected
function initIndex(id){
    const index = idUserSelected.indexOf(parseInt(id));
    const findIndex = arrayListUserSelected.findIndex(user => user.id == id);

    return [index, findIndex];
}

function handleReStoreUser(e) {
    if (e.target.classList.contains("btn-close")) {
        let id = e.target.dataset.id;
        let name = e.target.dataset.name;

        const [index,findIndex] = initIndex(id);
        restoreUser(arrayListUserSelected[findIndex].id, arrayListUserSelected[findIndex].name);

        if (index != -1) {
            idUserSelected.splice(index, 1);
        }

        e.target.parentElement.remove();
        e.preventDefault();

    }
}

function initSelectUser(id, name){
    addUser(id, name);
    idUserSelected.push(parseInt(id));

    const userDeleted = {
        id: id,
        name: name,
    };
    arrayListUserSelected.push(userDeleted);
}

function selectUsers(e) {
    if (e.target.classList.contains("user-check")) {
        let id = e.target.dataset.id;
        let name = e.target.dataset.name;

        if (!idUserSelected.includes(id)) {
            initSelectUser(id, name);
            e.target.parentElement.remove();
        }
        e.preventDefault();
    }

}

async function initSearchUser(value){
    let data = await searchDataUser(BASEURL, value, idUserSelected);
    listUser.innerHTML = data;
}


async function handleSearchUser(e) {
    if (e.key == "Enter") {
        try {
            await initSearchUser(e.target.value);
        } catch (error) {
            showAlertError(error);
        }
    }
}

function handleSubmit(e) {
    e.preventDefault();
}

async function handleTambahAnggota() {
    if (idUserSelected.length < 1) {
        showAlertError("Belum ada warga yang dipilih!");
    } else {
        try {
            let response = await tambahAnggotaJadwal(BASEURL, TOKEN, this.dataset.id, idUserSelected);
            showMessage(response.message, response.icon, response.status);
            btnTambahAnggota.disabled = true;
            if (response.status == "Berhasil") {
                setTimeout(() => {
                    document.location.reload(false);
                }, 1000);
            }
        } catch (error) {
            showAlertError(error)
        }
    }
}

function handleHapusWarga(e) {
    if (e.target.classList.contains("checkbox-absen")) {
        let btnHapus = document.getElementById("btn-hapus");
        if (e.target.checked) {
            btnHapus.classList.remove("d-none");
            idAbsensiDelete.push(parseInt(e.target.value));
            btnHapus.addEventListener("click", hapusWargaFromJadwal);
        } else {
            idAbsensiDelete.splice(idAbsensiDelete.indexOf(parseInt(e.target.value)));
        }
    }
    if(e.target.classList.contains("btn-hapus-warga")){
        deleteWarga(e.target.dataset.id, e.target.dataset.idu, e.target.dataset.name);
    }
}

async function deleteWarga(idAbsensi, userId, name){
    await showConfirm("Anda yakin ingin menghapus warga dari jadwal ronda?", "question", "Iya").then(async (result) => {
        if (result.isConfirmed) {
            try {
                let response = await deleteUserFromJadwal(BASEURL, TOKEN, idAbsensi);
                showSnackMessage(response.message, response.icon);
                if(response.status == "Berhasil"){
                    removeElemenCheckAbsen(idAbsensi);
                    restoreUser(parseInt(userId), name);
                    let btnHapus = getBtnHapus();
                    if(idAbsensiDelete.length < 1)
                        btnHapus.classList.add("d-none");
                    
                }
            } catch (error) {
                showSnackError(error);
            }
        }
    });
}


function handleHapusWargaFromJadwal()
{
    for(let el of Array.from(document.getElementsByClassName("checkbox-absen"))){
        let index = idAbsensiDelete.indexOf(parseInt(el.value));
        if(index!=-1){
            let checkAbsen = document.getElementById("check-absen-"+parseInt(el.value)).parentElement.parentElement.parentElement.parentElement.parentElement;
            idAbsensiDelete.splice(index, 1);
            checkAbsen.remove();
            restoreUser(parseInt(el.dataset.uid), el.dataset.name);
        }
    }
}

function removeElemenCheckAbsen(id){
    let checkAbsen = document.getElementById(`check-absen-${id}`);
    console.log(checkAbsen);
    let parentElement = checkAbsen.parentElement.parentElement.parentElement.parentElement.parentElement;
    parentElement.remove();
}



function getBtnHapus(){
    return document.getElementById("btn-hapus");
}

async function hapusWargaFromJadwal(e) {
    if (idAbsensiDelete.length < 1) showAlertError("Tidak ada warga yang dipilih!");
    else{
        await showConfirm("Anda yakin ingin menghapus warga dari jadwal?", "question", "Iya").then(async (result) => {
            if (result.isConfirmed) {
                try {
                    let response = await deleteUsersFromJadwal(BASEURL, TOKEN, idAbsensiDelete);
                    showSnackMessage(response.message, response.icon);
                    if (response.status == "Berhasil") {
                        handleHapusWargaFromJadwal();
                        let btnHapus = getBtnHapus();
                        btnHapus.classList.add("d-none");
                    }
                } catch (error) {
                    showAlertError(error);
                }
            }
        });
    }
}




listUser.addEventListener("click", selectUsers);
selectedUserContainer.addEventListener("click", handleReStoreUser);
searchUser.addEventListener("keyup", handleSearchUser);
formTambahAnggota.addEventListener("submit", handleSubmit);
btnTambahAnggota.addEventListener("click", handleTambahAnggota);
containerJadwal.addEventListener("click", handleHapusWarga);
