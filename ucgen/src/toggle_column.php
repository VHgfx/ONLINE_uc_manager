<script>
    function toggleEditQuestion() {
            var deleteColumn = document.querySelectorAll('.hidden-question');
            deleteColumn.forEach(function (column) {
                column.classList.toggle('hidden-question');
            });
        }

        function toggleDeleteColumn() {
            var deleteColumn = document.querySelectorAll('.hidden-column');
            deleteColumn.forEach(function (column) {
                column.classList.toggle('hidden-column');
            });
        }
        
        function toggleEditTypeColumn() {
            var deleteColumn = document.querySelectorAll('.hidden-type');
            deleteColumn.forEach(function (column) {
                column.classList.toggle('hidden-type');
            });
        }
</script>