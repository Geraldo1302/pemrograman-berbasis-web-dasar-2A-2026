document.addEventListener('DOMContentLoaded', () => {
    
    const contactForm = document.getElementById('contactForm');
    const contactEmail = document.getElementById('contactEmail');
    const emailError = document.getElementById('emailError');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) { 
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const emailValue = contactEmail.value.trim();

            if (emailValue === "") {  
                e.preventDefault();
                alert("Email tidak boleh kosong!");
            } 
            else if (!emailPattern.test(emailValue)) {
                e.preventDefault();
                if (emailError) {
                } else {
                    alert("Format email salah! Gunakan format: nama@contoh.com");
                }
            } 
            else {
                alert("Sukses! Email " + emailValue + " telah terdaftar.");
            }
        });
    }

const signUpBtn = document.querySelector('nav button');
if (signUpBtn) {
    signUpBtn.addEventListener('click', () => {
        const userName = prompt("Masukkan Nama Lengkap Anda:");
        if (userName === null) return; 

        if (userName.trim().length < 3) {
            alert("Gagal: Nama minimal harus 3 karakter!");
            return;
        }

        const userEmail = prompt("Masukkan Email Anda:");
        if (userEmail === null) return;

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(userEmail.trim())) {
            alert("Gagal: Format email tidak valid!");
        } else {
            alert(`Sukses Mendaftar!\nNama: ${userName}\nEmail: ${userEmail}\n\nData kamu sudah tersimpan.`);
        }
    });
}

    function highlightError(element) {
        element.style.border = "2px solid #ff4d4d";
        element.focus();
        setTimeout(() => {
            element.style.border = "";
        }, 2000);   
    }
});



const themeToggleBtn = document.getElementById('theme-toggle');
const themeIcon = document.getElementById('theme-toggle-icon');

function applyTheme() {
    if (document.documentElement.classList.contains('dark')) {
        themeIcon.innerText = "🌞"; 
        localStorage.setItem('theme', 'dark');
    }  else {
        themeIcon.innerText = "🌙"; 
        localStorage.setItem('theme', 'light');
    }
}

if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark');
    applyTheme();
}

themeToggleBtn.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
    applyTheme();
});