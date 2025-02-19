// function toogles sidebar

function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let overlay = document.getElementById('overlay');
    sidebar.classList.toggle("hidden");
    overlay.classList.toggle('show');
}

// rseponsive sidebar
function checkScreenSize() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if (window.matchMedia("(max-width: 767.98px)").matches) {
        sidebar.classList.add('hidden');
        overlay.classList.remove('show');
        // Sembunyikan sidebar saat layar kecil
    } else {
        sidebar.classList.remove('hidden'); // Tampilkan sidebar di desktop
    }
}

// Panggil fungsi saat halaman dimuat dan saat layar berubah
window.addEventListener('load', checkScreenSize);
window.addEventListener('resize', checkScreenSize);

// reset error
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        let errorMessages = document.querySelectorAll('.invalid-modal');
        errorMessages.forEach(function (error) {
            error.style.transition = "opacity 0.5s";
            error.style.opacity = "0";
            setTimeout(() => error.remove(), 500); // Hapus elemen setelah efek animasi
        });
    }, 5000);
});

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        let errorMessages = document.querySelectorAll('.btn-alert');
        errorMessages.forEach(function (error) {
            error.style.transition = "opacity 0.5s";
            error.style.opacity = "0";
            setTimeout(() => error.remove(), 500); // Hapus elemen setelah efek animasi
        });
    }, 3000);
});

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function (event) {
            const submitButton = event.submitter; // Dapatkan tombol yang diklik

            if (submitButton) {
                submitButton.disabled = true; // Nonaktifkan tombol
                submitButton.style.opacity = "0.75"; // Kurangi opacity
                submitButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`; // Ubah teks menjadi spinner
            }
        });
    });
});


