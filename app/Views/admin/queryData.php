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
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <!-- Validation -->
    <?= view('validation/flashData') ?>

    <!-- Content Row -->
    <div class="card border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= "Input :" ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('Admin/QueryData') ?>">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <textarea autocomplete="off" class="form-control" type="text" name="sql_param" id="sql_param" placeholder="Masukkan SQL Query..." rows="3" autofocus><?= old('sql_param'); ?></textarea>
                </div>
                <div>
                    <button type="submit" name="buttonProsesQuery" class="btn btn-primary">Proses Query</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Content Row -->
    <br>
    <?php
    if (!empty($resultQuery)) { ?>
        <div class="card border-left-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= "Result :" ?></h6>
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