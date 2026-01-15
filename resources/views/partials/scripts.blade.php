<script>
    // --- LOGIC NAVBAR TRANSITION ---
    const navPanel = document.getElementById('nav-panel');
    const navbarContainer = document.getElementById('navbar-container');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            // Saat scroll ke bawah: Muncul Background Putih/Kaca & Shadow
            navPanel.classList.remove('bg-transparent', 'border-transparent', 'shadow-none', 'py-4');
            navPanel.classList.add('bg-white/80', 'backdrop-blur-xl', 'border-white/50', 'shadow-lg', 'py-3');

            navbarContainer.classList.remove('pt-6');
            navbarContainer.classList.add('pt-2');
        } else {
            // Saat di paling atas: Transparan & Lebih Renggang
            navPanel.classList.add('bg-transparent', 'border-transparent', 'shadow-none', 'py-4');
            navPanel.classList.remove('bg-white/80', 'backdrop-blur-xl', 'border-white/50', 'shadow-lg', 'py-3');

            navbarContainer.classList.add('pt-6');
            navbarContainer.classList.remove('pt-2');
        }
    });

    // --- MOBILE MENU ---
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerBtn.addEventListener('click', () => {
        hamburgerBtn.classList.toggle('active');
        if (mobileMenu.classList.contains('invisible')) {
            mobileMenu.classList.remove('invisible', 'scale-95', 'opacity-0');
        } else {
            mobileMenu.classList.add('invisible', 'scale-95', 'opacity-0');
        }
    });

    // --- SCROLL REVEAL ---
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            if (elementTop < windowHeight - 100) reveals[i].classList.add("active");
        }
    }
    window.addEventListener("scroll", reveal);
    reveal();

    document.addEventListener("DOMContentLoaded", () => {
        const loader = document.getElementById("page-loader");

        // Saat klik link internal
        document.querySelectorAll("a[href]").forEach(link => {
            const url = link.getAttribute("href");

            if (
                url &&
                !url.startsWith("#") &&
                !url.startsWith("http") &&
                !link.hasAttribute("target")
            ) {
                link.addEventListener("click", e => {
                    e.preventDefault();
                    loader.classList.add("active");

                    setTimeout(() => {
                        window.location.href = url;
                    }, 400);
                });
            }
        });

        // Saat halaman selesai load
        window.addEventListener("load", () => {
            loader.classList.add("finish");
            setTimeout(() => loader.remove(), 600);
        });
    });
</script>