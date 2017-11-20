<?php
/*** Program ***/
require_once "{$_SERVER["DOCUMENT_ROOT"]}//lib/library.php";
requirePhp("view");
$recordList = getRecordList();
$admin = getSession("admin");
$sortBy = getGet("sort");
$successMsg = "Record deleted";

/*** View ***/
?>
<div class="row">
    <div class="col-xs-12">
        <?php printRecordList($recordList, $admin, $sortBy); ?>
    </div>
    <div id="successMsg" class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <?= $successMsg ?>
    </div>
</div>

<?php
/*** Functions ***/
function getRecordList() {
    $records = getRecordsAll();

    $list = [];
    foreach ($records as $record) {
        $list[] = [
            "id" => (int)$record->getId(),
            "title" => outHtml($record->getTitle()),
            "recordLink" => viewRecordLink($record),
            "artistLink" => viewArtistLink($record->getArtists()),
            "date" => viewDate($record->getReleaseDate()),
            "genre" => outHtml($record->getGenre()),
            "price" => viewPrice($record->getPrice())
        ];
    }

    return $list;
}

function printRecordList($recordList, $deletable, $sortBy = "") {
    if ($sortBy) {
        usort($recordList, function($a, $b) use ($sortBy) {
            if ($sortBy != "price") {
                return strcmp($a[$sortBy], $b[$sortBy]);
            } else {
                return parseDuration($a[$sortBy]) - parseDuration($b[$sortBy]);
            }
        });
    }

    echo <<<_END
<table class="table sortlist" data-content="records">
    <tbody>
        <tr>
_END;
    if ($deletable) {
        // Print delete button column
        echo "<th></th>";
    }
    echo <<<_END
            <th>#</th>
            <th data-sort="recordLink">Title</th>
            <th data-sort="artistLink">Artist</th>
            <th data-sort="date">Release Date</th>
            <th data-sort="genre">Genre</th>
            <th data-sort="price">Price</th>
        </tr>
_END;

    $i = 1;
    foreach ($recordList as $record) {
        echo "<tr>";
        if ($deletable) {
            echo <<<_END
            <td><a class="btn-delete" href="#" title="Delete record" data-id="{$record["id"]}" data-item="{$record["title"]}" data-action="delete_record"><span class="glyphicon glyphicon-remove"></a></td>
_END;
        }
            echo <<<_END
            <td>$i</td>
            <td>{$record["recordLink"]}</td>
            <td>{$record["artistLink"]}</td>
            <td>{$record["date"]}</td>
            <td>{$record["genre"]}</td>
            <td>{$record["price"]}</td>
        </tr>
_END;
        $i++;  
    }

    echo "</tbody></table>";
}
