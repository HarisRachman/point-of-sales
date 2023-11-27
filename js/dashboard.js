
// get total count  students;

const getTotalKategori = async () => {
    let total = document.querySelector("#kategori");
    const res = await fetch("api/dashboard/total-kategori.php", {
        method: "GET"
    })
    const output = await res.json();
    total.innerText = output;
}
getTotalKategori();

const getTotalProduk = async () => {
    let total = document.querySelector("#produk");
    const res = await fetch("api/dashboard/total-produk.php", {
        method: "GET"
    })
    const output = await res.json();
    total.innerText = output;
}
getTotalProduk();

const getTotalTrans = async () => {
    let total = document.querySelector("#transaksi");
    const res = await fetch("api/dashboard/total-transaksi.php", {
        method: "GET"
    })
    const output = await res.json();
    total.innerText = output;
}
getTotalTrans();