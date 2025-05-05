let currentIndex = 0;

document.addEventListener("DOMContentLoaded", function () {
    const modalImage = document.getElementById("modalImage");
    const imageDescription = document.getElementById("imageDescription");
    const modalTitle = document.getElementById("imageModalLabel");
    const imageCounter = document.getElementById("imageCounter");
    const images = document.querySelectorAll(".gallery-image");

    // Event listener untuk klik gambar
    images.forEach((img) => {
        img.addEventListener("click", function () {
            currentIndex = parseInt(img.getAttribute("data-img-index"), 10);
            updateModal(img);
        });
    });

    // Navigasi ke gambar sebelumnya
    document.getElementById("prevBtn").addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            const img = document.querySelector(`[data-img-index="${currentIndex}"]`);
            updateModal(img);
        }
    });

    // Navigasi ke gambar berikutnya
    document.getElementById("nextBtn").addEventListener("click", function () {
        const nextIndex = currentIndex + 1;
        const img = document.querySelector(`[data-img-index="${nextIndex}"]`);
        if (img) {
            currentIndex = nextIndex;
            updateModal(img);
        }
    });

    // Fungsi untuk memperbarui modal
    function updateModal(img) {
        modalImage.setAttribute("src", img.getAttribute("data-img-src"));
        imageDescription.textContent = img.getAttribute("data-img-description");
        modalTitle.textContent = img.getAttribute("data-img-name"); // Perbarui nama gambar di header
        updateImageCounter();
    }

    // Fungsi untuk memperbarui counter gambar
    // function updateImageCounter() {
    //     const totalImages = images.length;
    //     imageCounter.textContent = `Foto ${currentIndex + 1} dari ${totalImages}`;
    // }
});
