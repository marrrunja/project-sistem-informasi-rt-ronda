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