<?php
/*** Program ***/
require_once "{$_SERVER["DOCUMENT_ROOT"]}/record-store/lib/library.php";
requirePhp("view");
$sortBy = getGet("sort");
$recordList = getRecordList();
$successMsg = "Record deleted";

/*** View ***/
?>
<div class="col-xs-12">
    <?php printRecordList($recordList, $sortBy); ?>
</div>
<div id="successMsg" class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    <?= $successMsg ?>
</div>

<?php
/*** Functions ***/
function getRecordList() {
    $records = getRecordsAll();

    $list = [];
    foreach ($records as $record) {
        $list[] = [
            "id" => $record->getId(),
            "title" => $record->getTitle(),
            "recordLink" => viewRecordLink($record),
            "artistLink" => viewArtistLink($record->getArtists()),
            "date" => $record->getReleaseDate(),
            "genre" => $record->getGenre(),
            "price" => viewPrice($record->getPrice())
        ];
    }

    return $list;
}

function printRecordList($recordList, $sortBy = "") {
    if ($sortBy) {
        usort($recordList, function($a, $b) use ($sortBy) {
            if ($sortBy != "price") {
                return strcmp($a[$sortBy], $b[$sortBy]);
            } else {
                return (int)$a[$sortBy] - (int)$b[$sortBy];
            }
        });
    }

    echo <<<_END
<table class="table sortlist" data-content="records">
    <tbody>
        <tr>
            <th></th>
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
        echo <<<_END
        <tr>
            <td><a class="btn-delete" href="#" title="Delete record" data-id="{$record["id"]}" data-item="{$record["title"]}" data-action="delete_record"><span class="glyphicon glyphicon-remove"></a></td>
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

    echo <<<_END
    </tbody>
</table>
_END;
}
