
<script>
    function searchTable() {
        let input, filter, tables, tr, td, i, txtValue, lessColumn;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        tables = document.querySelectorAll(".table-2");
        <?php if ($current_page == 'uc_manager') : ?>
            lessColumn = 3;
        <?php elseif ($current_page == 'user_manager') : ?>
            lessColumn = 2;
        <?php else : ?>
            lessColumn = 0;
        <?php endif; ?>
        

        tables.forEach(function (table) {
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                let rowVisible = false;
                tds = tr[i].getElementsByTagName("td");

                for (j = 0; j < tds.length - lessColumn; j++) {
                    td = tds[j];

                    if (td) {
                        txtValue = td.textContent || td.innerText;

                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            rowVisible = true;
                            break;
                        }
                    }
                }

                tr[i].style.display = rowVisible ? "" : "none";
            }
        });
}
</script>