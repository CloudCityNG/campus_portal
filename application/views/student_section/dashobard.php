<?php $session = $this->session->userdata('admin_session'); ?>
<br />
<h1 class="cursive-font text-center">Welcome <?php echo ucwords(@$session->full_name); ?></h1>
<br />