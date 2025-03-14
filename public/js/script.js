
    // Fungsi untuk menampilkan modal hapus
    function showDeleteModal(complaintId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/complaints/${complaintId}`;
        modal.style.display = 'flex';
    }

    function showDeleteModalS(suggestionId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/suggestions/${suggestionId}`;
        modal.style.display = 'flex';
    }

    // Fungsi untuk menutup modal hapus
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
    }

    // Fungsi untuk menutup pesan sukses
    function closeSuccessMessage() {
        const successMessage = document.querySelector('.card-success');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }

    // Tutup modal jika mengklik di luar modal
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    // Animasi saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".animated");
    elements.forEach((element) => {
        element.style.opacity = "0";
        element.style.transform = "translateY(20px)";
    });

    setTimeout(() => {
        elements.forEach((element) => {
            element.style.opacity = "1";
            element.style.transform = "translateY(0)";
        });
    }, 100);
});