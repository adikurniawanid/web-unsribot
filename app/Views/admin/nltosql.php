<?php
echo $this->extend('/layout/template');
echo $this->section('content');

function arrayToTable($table)
{
    echo "<div class='table-responsive'>";

    echo "<table class='table table-bordered table-hover' 
    id='toDataTable' width='100%' cellspacing='0'>";

    echo "<thead class='text-center'>";
    echo "<tr>";
    // Table header
    foreach ($table[0] as $key => $value) {
        echo "<th>" . $key . "</th>";
    }

    echo "</tr>";
    echo "</thead>";

    echo "<tfoot class='text-center'>";
    echo "<tr>";
    // Table footer
    foreach ($table[0] as $key => $value) {
        echo "<th>" . $key . "</th>";
    }
    echo "</tr>";
    echo "</tfoot>";

    echo "<tbody class='text-center'>";
    // Table body
    foreach ($table as $value) {
        echo "<tr>";
        foreach ($value as $element) {
            echo "<td>" . $element . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody'>";
    echo "</table>";
    echo "</div>";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 text-gray-800"><b>[Work-in-Progress]</b></h1> -->
    <h1 class="h3 mb-4 text-gray-800">Natural Language to Structured Query Language</h1>

    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <!-- Content Row -->
    <div class="card border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= "Input :" ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/NlToSql') ?>">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <textarea autocomplete="off" class="form-control" type="text" name="input_param" id="input_param" placeholder="Masukkan Natural Language..." rows="3" autofocus><?= old('input_param'); ?></textarea>
                </div>
                <div>
                    <button type="submit" name="buttonProsesNlToSql" class="btn btn-primary">Proses NL to SQL</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="<?= base_url('Admin/Dataset/NL') ?>" class="btn btn-primary btn-icon-split mb-3" style="float: right;">
                        <span class="icon text-white-50">
                            <i class="fa fa-archive"></i>
                        </span>
                        <span class="text">Dataset NL</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($text)) : ?>
        <br>
        <div class="card border-left-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= "Proses :" ?></h6>
            </div>
            <div class="card-body">
                <pre>
            <?php
            $text = escapeshellarg($text);
            system("/bin/python3 /home/akdev/Documents/GitHub/web-unsribot/app/PyCode/Main.py {$text}");
            ?>
            </pre>
            </div>
        </div>
        <br>
    <?php endif ?>

    <!-- Content Row -->
    <?php
    if (!empty($resultQuery)) { ?>
        <br>
        <div class="card border-left-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= "Result [Dummy] :" ?></h6>
            </div>
            <div class="card-body">
                <?php
                arrayToTable($resultQuery); ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>