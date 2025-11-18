import { showConfirm } from "./utility/alert.js";

const formLogout = document.getElementById("formLogout");

console.log(formLogout)
async function logout(e) {
    e.preventDefault();
    await showConfirm("Anda yakin ingin logout?", "question", "Iya").then(async (result) => {
        if (result.isConfirmed) {
           formLogout.submit();
        }
    });
}
formLogout.addEventListener("submit", logout);
