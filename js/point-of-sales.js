let modal = document.querySelector("#add-cart");
let cancel = document.querySelector("#cancel")
let addCart = document.querySelector("#addToCart")
let modalTrans = document.querySelector("#add-transaksi");
let cancelTrans = document.querySelector("#cancel-trans")
let addTrans = document.querySelector("#finish-trans")
let success = document.querySelector(".alert-success")
let error = document.querySelector(".alert-danger")
let btn_pay = document.getElementById("total");
// select Student

cancel.addEventListener("click", () => {
    modal.style.display = "none";
})

cancelTrans.addEventListener("click", () => {
    modalTrans.style.display = "none";
})

const getKategori = async () => {
    try {
        const tbody = document.getElementById("list-kategori");
        let tr = "";
        const res = await fetch("api/point-of-sales/list-kategori.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<p>Belum ada Kategori</p>"
        } else {
            for (var i in output) {
                tr += `<div class='category' onclick='filterProduk(${output[i].id})'><center><img src='img/kategori/${output[i].image}' height='50px' width='auto'><p style='text-align:center'>${output[i].nama}</p></center></div>`
            }
        }

        tbody.insertAdjacentHTML('beforeend', tr);
    } catch (error) {
        console.log("error " + error)
    }
}

getKategori();

const getProduk = async () => {
    try {
        const tbody = document.getElementById("list-produk");
        let tr = "";
        const res = await fetch("api/point-of-sales/list-produk.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<p>Belum ada Produk</p>"
        } else {
            for (var i in output) {
                tr += `<div class='item' onclick='addToCart(${output[i].id})'><center><img src='img/produk/${output[i].image}' height='75px' width='auto'><p style='margin-top:10px;text-align:center'>${output[i].nama}</p><p style='text-align:center'>Rp. ${output[i].harga}</p><p style='text-align:center'>Stok: ${output[i].stok}</p></center></div>`
            }
        }

        tbody.replaceChildren();
        tbody.insertAdjacentHTML('beforeend', tr);
    } catch (error) {
        console.log("error " + error)
    }
}

getProduk();

const getCart = async () => {
    try {
        const tbody = document.getElementById("table-cart");
        let tr = "";
        const res = await fetch("api/point-of-sales/get-cart.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            btn_pay.style.display = "none";
            tr = "<tr><td colspan='3' style='text-align:center'>Cart Kosong</td></tr>"
        } else {
            btn_pay.style.display = "flex";
            for (var i in output) {
                tr += `
                    <tr>
                    <td>${output[i].nama} (${output[i].qty})</td>
                    <td>Rp. ${output[i].subTotal}</td>
                    <td><span style="cursor:pointer" onclick='deleteItem(${output[i].id_cart}, ${output[i].id}, ${output[i].qty})'><i class="fa fa-trash"></i></span></td>
                    </tr>`
            }
        }
        tbody.innerHTML = tr;
    } catch (error) {
        console.log("error " + error)
    }
}

getCart();

const deleteItem = async (id, id_produk, qty) => {
    const res = await fetch("api/point-of-sales/deleteItem.php?id=" + id + "&id_produk=" + id_produk + "&qty=" + qty, {
        method: "GET",
    });
    const output = await res.json();
    if (output.success) {
        getCart();
        getProduk();
        getsubTotal();
    } else {
        
    }
}

const getsubTotal = async () => {
    try {
        const tbody = document.getElementById("total");
        let tr = "";
        const res = await fetch("api/point-of-sales/totalHarga.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<a href='#' disabled>Pay Rp. 0</a>"
        } else {
            for (var i in output) {
                tr += `<a onclick='AddTrans()'>Pay Rp. ${output[i].totalHarga}</a>`
            }
        }

        tbody.replaceChildren();
        tbody.insertAdjacentHTML('beforeend', tr);
    } catch (error) {
        console.log("error " + error)
    }
}

getsubTotal();

const AddTrans = async () => {
    modalTrans.style.display = "flex";
    
    const res = await fetch("api/point-of-sales/totalHarga.php", {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output = await res.json();
    if (output["empty"] !== "empty") {
        for (var i in output) {
            document.querySelector("#total_harga").value = output[i].totalHarga
        }
    }
    
}

const filterProduk = async (id) => {
    try {
        const tbody = document.getElementById("list-produk");

        let tr = "";
        const res = await fetch(`api/point-of-sales/filter-produk.php?id=${id}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<p>Kategori ini belum memiliki produk.</p>"
        } else {
            for (var i in output) {
                tr += `<div class='item' onclick='addToCart(${output[i].id})'><center><img src='img/produk/${output[i].image}' height='75px' width='auto'><p style='margin-top:10px;text-align:center'>${output[i].nama}</p><p style='text-align:center'>Rp. ${output[i].harga}</p><p style='text-align:center'>Stok: ${output[i].stok}</p></center></div>`
            }
        }

        tbody.replaceChildren();
        tbody.insertAdjacentHTML('beforeend', tr);
    } catch (error) {
        console.log("error " + error)
    }
}

const addToCart = async (id) => {
    modal.style.display = "flex";
    
    const res = await fetch(`api/point-of-sales/get-produk.php?id=${id}`, {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output = await res.json();
    if (output["empty"] !== "empty") {
        for (var i in output) {
            document.querySelector("#id").value = output[i].id
            document.querySelector("#edit_produk").value = output[i].nama
            document.querySelector("#edit_harga").value = output[i].harga
            document.getElementById("qty").value = 1
            document.getElementById("qty").setAttribute("max", output[i].stok)
        }
    }
}

addCart.addEventListener("click", async () => {
    try {
        let id_produk = document.getElementById("id").value;
        let qty = document.getElementById("qty").value;
        let harga = document.getElementById("edit_harga").value;
        let subTotal;
        subTotal = qty * harga;

        const res = await fetch("api/point-of-sales/addCart.php", {
            method: "POST",
            body: JSON.stringify({ 
                "id_produk": id_produk,
                "qty": qty,
                "subTotal": subTotal, 
            }),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();

        if (output.success) {
            success.style.display = "flex";
            success.innerText = output.message;
            kategori = "";
            image = "";
            modal.style.display = "none";
            getCart();
            getProduk();
            getsubTotal();
            setTimeout(() => {
                success.style.display = "none";
                success.innerText = "";

            }, 1000)

        } else {
            error.style.display = "flex";
            error.innerText = output.message;
            setTimeout(() => {
                error.style.display = "none";
                error.innerText = "";

            }, 1000)
        }
    } catch (error) {
        error.style.display = "flex";
        error.innerText = error.message;
        setTimeout(() => {
            error.style.display = "none";
            error.innerText = "";

        }, 1000)
    }
});

addTrans.addEventListener("click", async () => {
    try {
        let nama = document.getElementById("nama_pelanggan").value;
        let harga = document.getElementById("total_harga").value;
        let bayar = document.getElementById("total_bayar").value;
        let kembalian;
        kembalian = bayar - harga;

        const res = await fetch("api/point-of-sales/addTransaksi.php", {
            method: "POST",
            body: JSON.stringify({ 
                "nama": nama,
                "harga": harga,
                "bayar": bayar,
                "kembalian": kembalian, 
            }),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();

        if (output.success) {
            success.style.display = "flex";
            success.innerText = output.message;
            kategori = "";
            image = "";
            modalTrans.style.display = "none";
            getCart();
            getsubTotal();
            setTimeout(() => {
                success.style.display = "none";
                success.innerText = "";

            }, 1000)

        } else {
            error.style.display = "flex";
            error.innerText = output.message;
            setTimeout(() => {
                error.style.display = "none";
                error.innerText = "";

            }, 1000)
        }
    } catch (error) {
        error.style.display = "flex";
        error.innerText = error.message;
        setTimeout(() => {
            error.style.display = "none";
            error.innerText = "";

        }, 1000)
    }
});