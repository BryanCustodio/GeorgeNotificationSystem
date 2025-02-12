<?php
include '../db/dbcon.php';
?>

<h2>Add New Question</h2>
<form id="addQuestionForm" method="POST" action="../function/add-questions.php">
    <input type="text" name="question_text" placeholder="Enter question" required>
    <input type="text" name="option_a" placeholder="Option A" required>
    <input type="text" name="option_b" placeholder="Option B" required>
    <input type="text" name="option_c" placeholder="Option C" required>
    <input type="text" name="option_d" placeholder="Option D" required>
    <select name="correct_option" required>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>
    <button type="submit">Add Question</button>
</form>

<h2>Update or Delete Questions</h2>

<!-- DataTable for Questions -->
<table id="questionsTable" class="display">
    <thead>
        <tr>
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th>Correct Answer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = $conn->query("SELECT * FROM questions");
        while ($row = $query->fetch_assoc()) {
            echo "<tr id='row_{$row['id']}'>
                <td>{$row['question_text']}</td>
                <td>{$row['option_a']}</td>
                <td>{$row['option_b']}</td>
                <td>{$row['option_c']}</td>
                <td>{$row['option_d']}</td>
                <td>{$row['correct_option']}</td>
                <td>
                    <button class='edit-btn' data-id='{$row['id']}' data-question='{$row['question_text']}' data-a='{$row['option_a']}' data-b='{$row['option_b']}' data-c='{$row['option_c']}' data-d='{$row['option_d']}' data-correct='{$row['correct_option']}'>Edit</button>
                    <button class='delete-btn' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<script src="../js/dynamic-add.js"></script>
<script src="../js/dynamic-edit.js"></script>
<script src="../js/dynamic-delete.js"></script>