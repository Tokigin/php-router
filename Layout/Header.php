<?php
$root = "/php-router";
?>
<nav class="navbar navbar-expand-lg bg-dark" style="height:5vh;">
    <div class="container-fluid">
        <a class="navbar-brand text-white fs-1 fw-bold" href="<?php echo $root ?>">Cannel </a>
        <button class="navbar-toggler  border border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item d-flex gap-2">
                    <a class="nav-link text-white" href="<?php echo $root ?>">Home</a>
                    <a class="nav-link text-white" href="<?php echo $root ?>/guide">Guide</a>
                </li>
            </ul>

        </div>
    </div>
</nav>