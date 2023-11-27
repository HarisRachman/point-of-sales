let create = document.querySelector("#create");
let modal = document.querySelector("#create-produk");
let update_model = document.querySelector("#update-produk");
let close = document.querySelector("#close")
let update_close = document.querySelector("#update_close")
let save = document.querySelector("#save");
let update = document.querySelector("#update");
let success = document.querySelector(".alert-success")
let error = document.querySelector(".alert-danger")


create.addEventListener("click", () => {
    modal.style.display = "flex";
});
close.addEventListener("click", () => {
    modal.style.display = "none";
})
update_close.addEventListener("click", () => {
    update_model.style.display = "none";

})


save.addEventListener("click", async () => {
    try {
        let nama = document.getElementById("nama").value;
        let kategori = document.getElementById("kategori-produk").value;
        let stok = document.getElementById("stok").value;
        let price = document.getElementById("price").value;
        let image = document.getElementById("image");

        const res = await fetch("api/produk/store.php", {
            method: "POST",
            body: JSON.stringify({ 
                "nama": nama,
                "kategori": kategori,
                "stok": stok,
                "price": price, 
                "image": image.files[0].name
            }),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const formData = new FormData();
        formData.append("image", image.files[0]);

        fetch("api/produk/store-image.php", {
            method: "POST",
            body: formData
        }).catch(console.error);

        const output = await res.json();

        if (output.success) {
            success.style.display = "flex";
            success.innerText = output.message;
            nama = "";
            kategori = "";
            stok = "";
            price = "1";
            image = "";
            modal.style.display = "none";
            getProduk();
            getTotalCount();
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


const getProduk = async () => {
    try {
        const tbody = document.querySelector("#tbody");
        let tr = "";
        const res = await fetch("api/produk/index.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<tr><td colspan='7' style='text-align:center'>Record Not Found</td></tr>"
        } else {
            for (var i in output) {
                tr += `
            <tr>
            <td>${parseInt(i) + 1}</td>
            <td>${output[i].nama}</td>
            <td>${output[i].kategori}</td>
            <td><img src="img/produk/${output[i].image}" width="auto" height="75px"></td>
            <td>${output[i].stok}</td>
            <td>${output[i].harga}</td>
            <td><button onclick="editProduk(${output[i].id})" class="btn btn-success">Edit</button>
            <button onclick="deleteProduk(${output[i].id})"  class="btn btn-danger">Delete</button></td>
            </tr>`
            }
        }
        tbody.innerHTML = tr;
    } catch (error) {
        console.log("error " + error)
    }
}

getProduk();

const getKategori = async () => {
    try {
        const option = document.querySelector("#kategori-produk");
        let opt = "";
        const res = await fetch("api/kategori/index.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            opt = "<option value=''>Record Not Found</option>"
        } else {
            for (var i in output) {
                opt += `<option value='${output[i].id}'>${output[i].nama}</option>`
            }
        }
        option.innerHTML = opt;
    } catch (error) {
        console.log("error " + error)
    }
}

getKategori();


const editProduk = async (id) => {
    update_model.style.display = "flex";

    try {
        const option = document.querySelector("#edit-kategori");
        let opt = "";
        const res = await fetch("api/kategori/index.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            opt = "<option value=''>Record Not Found</option>"
        } else {
            for (var i in output) {
                opt += `<option value='${output[i].id}'>${output[i].nama}</option>`
            }
        }
        option.innerHTML = opt;
    } catch (error) {
        console.log("error " + error)
    }

    const res = await fetch(`api/produk/edit.php?id=${id}`, {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output = await res.json();
    if (output["empty"] !== "empty") {
        for (var i in output) {
            document.querySelector("#id").value = output[i].id
            document.querySelector("#edit-kategori").value = output[i].id_kategori
            document.querySelector("#gambar").value = output[i].image
            document.querySelector("#edit-nama").value = output[i].nama
            document.querySelector("#edit-stok").value = output[i].stok
            document.querySelector("#edit-price").value = output[i].harga
        }
    }

}

update.addEventListener("click", async () => {
    let id = document.querySelector("#id").value;
    let kategori = document.getElementById("edit-kategori").value;
    let nama = document.getElementById("edit-nama").value;
    let stok = document.getElementById("edit-stok").value;
    let price = document.getElementById("edit-price").value;
    let image = document.getElementById("edit-image");
    let gambarOld = document.querySelector("#gambar").value;

    let gambar;
    if (image.files[0] == undefined) {
        gambar = gambarOld;
    } else {
        gambar = image.files[0].name;
    }

    const res = await fetch("api/produk/update.php", {
        method: "POST",
        body: JSON.stringify({
            "id": id,
            "kategori": kategori,
            "nama": nama,
            "stok": stok,
            "price": price,
            "image": gambar
        })
    });

    const formData = new FormData();
    formData.append("image", image.files[0]);
    formData.append("imageOld", gambarOld);

    fetch("api/produk/update-image.php", {
        method: "POST",
        body: formData
    }).catch(console.error);

    const output = await res.json();
    if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        nama = "";
        kategori = "";
        stok = "";
        price = "1";
        image = "";
        update_model.style.display = "none";
        getProduk();
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

})

const deleteProduk = async (id) => {
    const res = await fetch("api/produk/delete.php?id=" + id, {
        method: "GET",
    });

    const output = await res.json();
    if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        setTimeout(() => {
            success.style.display = "none";
            success.innerText = "";
        }, 1000)
        getProduk();
        getTotalCount();
    } else {
        error.style.display = "flex";
        error.innerText = output.message;
        setTimeout(() => {
            error.style.display = "none";
            error.innerText = "";
        }, 1000)
    }
}

const getTotalCount = async () => {
    let total = document.querySelector("#total");
    const res = await fetch("api/produk/total-data.php", {
        method: "GET"
    })
    const output = await res.json();
    total.innerText = output;
}
getTotalCount();