<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {

	if (isset($_POST['id_2'])) {

		# database connection file
		include '../db.conn.php';

		$id_1  = $_SESSION['user_id'];
		$id_2  = $_POST['id_2'];
		$opend = 0;

		$sql = "SELECT * FROM chats
	        WHERE to_id=?
	        AND   from_id= ?
	        ORDER BY chat_id ASC";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id_1, $id_2]);

		$sql1 = "SELECT * FROM users WHERE user_id =?";
		$result1 = $conn->prepare($sql1);
		$result1->execute([$id_2]);
		$results1 = $result1->fetch(MYSQLI_ASSOC);


		if ($stmt->rowCount() > 0) {
			$chats = $stmt->fetchAll();

			# looping through the chats
			foreach ($chats as $chat) {
				if ($chat['opened'] == 0) {

					$opened = 1;
					$chat_id = $chat['chat_id'];

					$sql2 = "UPDATE chats
	    		         SET opened = ?
	    		         WHERE chat_id = ?";
					$stmt2 = $conn->prepare($sql2);
					$stmt2->execute([$opened, $chat_id]);

?>
					<div class="d-flex align-items-center">
						<img src="<?php echo $results1['p_p']; ?>" class="chat-img me-3 rounded-circle">
						<p class="ltext border align-self-start 
					         rounded p-2 mb-1">
							<?= $chat['message'] ?>
						</p>
					</div>

<?php
				}
			}
		}
	}
} else {
	header("Location: ../../index.php");
	exit;
}
