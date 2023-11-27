let detail = document.querySelector("#detail-trans");
let close = document.querySelector("#close-detail")

close.addEventListener("click", () => {
    detail.style.display = "none";
})

const getProduk = async () => {
    try {
        const tbody = document.querySelector("#tbody");
        let tr = "";
        const res = await fetch("api/transaksi/index.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<tr><td colspan='8' style='text-align:center'>Record Not Found</td></tr>"
        } else {
            for (var i in output) {
                tr += `
            <tr>
            <td>${parseInt(i) + 1}</td>
            <td>${output[i].pelanggan}</td>
            <td>${output[i].kasir}</td>
            <td>${output[i].harga}</td>
            <td>${output[i].bayar}</td>
            <td>${output[i].kembalian}</td>
            <td>${output[i].tanggal}</td>
            <td><button class="btn btn-success" onclick="editProduk(${output[i].id})">View</button></td>
            </tr>`
            }
        }
        tbody.innerHTML = tr;
    } catch (error) {
        console.log("error " + error)
    }
}

getProduk();


const editProduk = async (id) => {
    detail.style.display = "flex";

    const res = await fetch(`api/transaksi/detail.php?id=${id}`, {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output = await res.json();
    if (output["empty"] !== "empty") {
        for (var i in output) {
            document.querySelector("#nama_pelanggan").value = output[i].nama
            document.querySelector("#total_harga").value = output[i].total_harga
            document.querySelector("#total_bayar").value = output[i].total_bayar
            document.querySelector("#kembalian").value = output[i].kembalian
        }
    }

    const tbody = document.querySelector("#tbody-detail");
    let tr = "";
    const res2 = await fetch(`api/transaksi/detail-table.php?id=${id}`, {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output2 = await res2.json();
    if (output2["empty"] !== "empty") {
        for (var i in output2) {
            tr += `
        <tr>
        <td>${parseInt(i) + 1}</td>
        <td>${output2[i].produk}</td>
        <td>${output2[i].harga}</td>
        <td>${output2[i].qty}</td>
        <td>${output2[i].subtotal}</td>
        </tr>`
        }
        tbody.innerHTML = tr;
    }

}


const getTotalCount = async () => {
    let total = document.querySelector("#total");
    const res = await fetch("api/transaksi/total-data.php", {
        method: "GET"
    })
    const output = await res.json();
    total.innerText = output;
}
getTotalCount();