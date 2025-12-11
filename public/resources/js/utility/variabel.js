export const BASEURL = document.querySelector("meta[name=_baseurl]").content;
export const TOKEN = document.querySelector("meta[name=_token").content;
export function formatTanggalIndo(tanggal) {
    const date = new Date(tanggal);

    const bulanIndo = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const hari = date.getDate();
    const bulan = bulanIndo[date.getMonth()];
    const tahun = date.getFullYear();

    return `${hari} ${bulan} ${tahun}`;
}

