const sidebar = document.querySelector(".sidebar");

function OpenSidebar() {
    sidebar.style.display = "flex";
    sidebar.classList.remove("closed");
}

function CloseSidebar() {
    sidebar.classList.add("closed");

    setTimeout(() => {
        sidebar.style.display = "none";
    }, 700);
}
