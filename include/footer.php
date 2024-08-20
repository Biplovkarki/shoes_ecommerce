<!-- ... Your HTML head section and styles ... -->

<!-- jQuery (Make sure to include this before your custom script) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Custom script to highlight the active page in navigation -->
<script>
    $(document).ready(function () {
        // Get the current URL
        var url = window.location.href;

        // Handle click events on navigation links
        $('.navbar-nav a').click(function () {
            // Remove 'active' class from all nav links
            $('.navbar-nav a').removeClass('active');

            // Add 'active' class to the clicked nav link
            $(this).addClass('active');

            // Reset styles for all nav links
            $('.navbar-nav a').css({
                'transform': 'none',
                'font-weight': 'normal'
            });

            // Apply styles to the clicked nav link
            $(this).css({
                'transform': 'scale(1.25, 1.5)',
                'font-weight': 'bold'
            });
        });

        // Highlight the current page link based on the URL
        $('.navbar-nav a').each(function () {
            if (url.includes($(this).attr('href'))) {
                $(this).addClass('active');
                $(this).css({
                    'transform': 'scale(1.2, 1.5)',
                    'font-weight': 'bold'
                });
            }
        });
    });

</script>
<!-- Add this script at the end of your HTML body -->




</body>
</html>