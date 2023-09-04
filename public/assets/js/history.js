$(document).ready(function () {
    $("tr").hover(
        function () {
            $(this).find(".date-container div:first-child").slideUp();
            $(this).find(".date-container div:nth-child(2)").slideDown();
        },
        function () {
            $(this).find(".date-container div:first-child").slideDown();
            $(this).find(".date-container div:nth-child(2)").slideUp();
        }
    );
});
