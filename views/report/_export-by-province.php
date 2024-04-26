<style> .str{ mso-number-format:\@; } </style>
<table class="table table-bordered table-hover">
    <tr>
        <th>No.</th>
        <th>Provinsi</th>
        <th>Banyak Penduduk</th>
    </tr>
    <?php
        $no = 1;
        foreach ($model as $key => $val) {
            echo "<tr>";
            echo "<td class=\"str\">{$no}</td>";
            echo "<td class=\"str\">{$val['name']}</td>";
            echo "<td class=\"str\">{$val['jumlah']}</td>";
            echo "</tr>";

            $no++;
        }
    ?>
</table>