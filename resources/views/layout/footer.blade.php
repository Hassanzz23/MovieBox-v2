<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const button = document.getElementById('themeToggle');

        const savedTheme =
            localStorage.getItem('moviebox-theme');


        // Set initial theme

        if (savedTheme === 'dark') {

            document.documentElement.setAttribute(
                'data-bs-theme',
                'dark'
            );

        } else {

            document.documentElement.setAttribute(
                'data-bs-theme',
                'light'
            );

        }


        // Toggle

        if (button) {

            button.addEventListener('click', function () {

                const current =
                    document.documentElement.getAttribute(
                        'data-bs-theme'
                    );


                if (current === 'dark') {

                    document.documentElement.setAttribute(
                        'data-bs-theme',
                        'light'
                    );

                    localStorage.setItem(
                        'moviebox-theme',
                        'light'
                    );

                } else {

                    document.documentElement.setAttribute(
                        'data-bs-theme',
                        'dark'
                    );

                    localStorage.setItem(
                        'moviebox-theme',
                        'dark'
                    );

                }

            });

        }

    });

</script>

</body>

</html>
