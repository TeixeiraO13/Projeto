
document.getElementById("cadastro-btn").addEventListener("click", function() {
    this.style.transform = "scale(0.95)";
    setTimeout(() => {
        this.style.transform = "scale(1)";
    }, 200);
});