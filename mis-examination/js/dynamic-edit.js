$(document).ready(function() {
    $('#questionsTable').DataTable();

    // Edit Button Click
    $(".edit-btn").click(function() {
        var id = $(this).data("id");
        $("#question_id").val(id);
        $("#question_text").val($(this).data("question"));
        $("#option_a").val($(this).data("a"));
        $("#option_b").val($(this).data("b"));
        $("#option_c").val($(this).data("c"));
        $("#option_d").val($(this).data("d"));
        $("#correct_option").val($(this).data("correct"));

        $("#editModal").show();
    });

    // Close Modal
    $(".close").click(function() {
        $("#editModal").hide();
    });

    // AJAX Update Question
    $("#editForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "../function/update-table.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });
});