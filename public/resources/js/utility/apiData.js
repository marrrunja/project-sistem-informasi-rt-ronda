export async function getDataReport(url, offset){
    const response = await fetch(url+"/report/get?offset="+offset);
    
    if(!response.ok){
        throw new Error("ERROR " + response.status);
    }
    const data = await response.json();
    return data;
}

export async function getTotalDataFromReport(url)
{
    const response = await fetch(url + "/report/total");
    if(!response.ok){
        throw new Error("ERROR " + response.status);
    }
    const data = await response.json();
    return data;
}

export async function getDetailLaporan(url, id){
    const response = await fetch(url + "/report/detail?id=" + id);
    if(!response.ok){
        throw new Error("ERROR " + response.status);
    }
    const data = await response.text();
    return data;
}

export async function getFotoFromReport(url, id){
    const response = await fetch(url + "/report/foto?id=" + id);
    if(!response.ok){
        throw new Error("ERROR " + response.status);
    }
    const data = await response.json();
    return data;
}

export async function getDetailUser(url, id){
    const response = await fetch(url + "/user/detail?id=" + id);
    if(!response.ok){
        throw new Error("ERROR " + response.status);
    }
    const data = await response.text();
    console.log(data);
    return data;
}

export async function editData(url, id, nama, wa, alamat, token){
    const response = await fetch(url + "/user/edit", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': token
        },
        body:JSON.stringify({
            id:id,
            nama:nama,
            wa:wa,
            alamat:alamat
        })
    });

   if (!response.ok) {
       throw new Error("ERROR " + response.status);
    }
    let success = await response.json();
    return success;
}

export async function blokirUser(url, id,token){
     const response = await fetch(url + "/admin/blokir", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': token
        },
        body:JSON.stringify({
            id:id,
        })
    });

   if (!response.ok) {
       throw new Error("ERROR " + response.status);
    }
    let success = await response.json();
    return success;
}

export async function bukaBlokir(url, id,token){
    const response = await fetch(url + "/admin/bukablokir", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': token
        },
        body:JSON.stringify({
            id:id,
        })
    });

   if (!response.ok) {
       throw new Error("ERROR " + response.status);
    }
    let success = await response.json();
    return success;
}

export async function tambahJadwal(url, token, tanggal)
{
    const response = await fetch(url + "/admin/add/jadwal", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': token
        },
        body:JSON.stringify({
            tanggal:tanggal
        })
    });

   if (!response.ok) {
       throw new Error("ERROR " + response.status);
    }
    let success = await response.json();
    return success;
}

export async function ubahAbsensi(url, token, status, id){
    const response = await fetch(url + "/absensi/ubah", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': token
        },
        body:JSON.stringify({
            status:status,
            id:id
        })
    });

   if (!response.ok) {
       throw new Error("ERROR " + response.status);
    }
    let success = await response.json();
    return success;
}