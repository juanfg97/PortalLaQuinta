     // Funcionalidad del menú hamburguesa
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mainNav = document.getElementById('mainNav');

        if (mobileMenuToggle && mainNav) {
            mobileMenuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('show');
                this.classList.toggle('active');
                
              
            });
        }

        // Función para cerrar el menú al hacer clic en un enlace
        function closeMenu() {
            if (window.innerWidth <= 768) {
                mainNav.classList.remove('show');
                mobileMenuToggle.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }

        // Cerrar menú al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                const isClickInsideNav = mainNav.contains(event.target);
                const isClickOnToggle = mobileMenuToggle.contains(event.target);
                
                if (!isClickInsideNav && !isClickOnToggle && mainNav.classList.contains('show')) {
                    closeMenu();
                }
            }
        });

        // Manejar redimensión de ventana
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                mainNav.classList.remove('show');
                mobileMenuToggle.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });