let create = document.querySelector("#create");
let modal = document.querySelector("#create-kategori");
let update_model = document.querySelector("#update-kategori");
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
        let kategori = document.getElementById("kategori").value;
        let image = document.getElementById("image");

        const res = await fetch("api/kategori/store.php", {
            method: "POST",
            body: JSON.stringify({ "kategori": kategori, "image": image.files[0].name }),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const formData = new FormData();
        formData.append("image", image.files[0]);

        fetch("api/kategori/store-image.php", {
            method: "POST",
            body: formData
        }).catch(console.error);

        const output = await res.json();

        if (output.success) {
            success.style.display = "flex";
            success.innerText = output.message;
            kategori = "";
            image = "";
            modal.style.display = "none";
            getKategori();
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


const getKategori = async () => {
    try {
        const tbody = document.querySelector("#tbody");
        let tr = "";
        const res = await fetch("api/kategori/index.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<tr><td colspan='4' style='text-align:center'>Record Not Found</td></tr>"
        } else {
            for (var i in output) {
                tr += `
            <tr>
            <td>${parseInt(i) + 1}</td>
            <td>${output[i].nama}</td>
            <td><img src="img/kategori/${output[i].image}" width="auto" height="75px"></td>
            <td><button onclick="editKategori(${output[i].id})" class="btn btn-success">Edit</button>
            <button onclick="deleteKategori(${output[i].id})"  class="btn btn-danger">Delete</button></td>
            </tr>`
            }
        }
        tbody.innerHTML = tr;
    } catch (error) {
        console.log("error " + error)
    }
}

getKategori();


const editKategori = async (id) => {
    update_model.style.display = "flex";

    const res = await fetch(`api/kategori/edit.php?id=${id}`, {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output = await res.json();
    if (output["empty"] !== "empty") {
        for (var i in output) {
            document.querySelector("#id").value = output[i].id
            document.querySelector("#edit_kategori").value = output[i].nama
            document.querySelector("#gambar").value = output[i].image
        }
    }
}


update.addEventListener("click", async () => {
    let id = document.querySelector("#id").value;
    let kategori = document.getElementById("edit_kategori").value;
    let image = document.getElementById("edit_image");
    let gambarOld = document.querySelector("#gambar").value;

    let gambar;
    if (image.files[0] == undefined) {
        gambar = gambarOld;
    } else {
        gambar = image.files[0].name;
    }

    const res = await fetch("api/kategori/update.php", {
        method: "POST",
        body: JSON.stringify({
            "id": id,
            "kategori": kategori,
            "image": gambar
        })
    });

    const formData = new FormData();
    formData.append("image", image.files[0]);
    formData.append("imageOld", gambarOld);

    fetch("api/kategori/update-image.php", {
        method: "POST",
        body: formData
    }).catch(console.error);

    const output = await res.json();
    if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        kategori = "";
        image = "";
        update_model.style.display = "none";
        getKategori();
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


const deleteKategori = async (id) => {
    const res = await fetch("api/kategori/delete.php?id=" + id, {
        method: "GET",
    });

    // const formData = new FormData();
    // formData.append("image", image.files[0]);
    // formData.append("imageOld", gambarOld);

    // fetch("api/kategori/update-image.php", {
    //     method: "POST",
    //     body: formData
    // }).catch(console.error);

    const output = await res.json();
    if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        setTimeout(() => {
            success.style.display = "none";
            success.innerText = "";
        }, 1000)
        getKategori();
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
    const res = await fetch("api/kategori/total-data.php", {
        method: "GET"
    })
    const output = await res.json();
    total.innerText = output;
}
getTotalCount();