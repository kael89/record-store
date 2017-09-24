<?php
/*** Program ***/
require_once "{$_SERVER["DOCUMENT_ROOT"]}/record-store/lib/library.php";
requirePhp("view");
$sortBy = getGet("sort");
$recordList = getRecordList();

/*** View ***/
?>
<div id="listContainer" class="row">
    <div class="col-xs-12">
        <?php printRecordList($recordList, $sortBy); ?>
    </div>
</div>

<?php
/*** Functions ***/
function getRecordList() {
    $records = getRecordsAll();

    $list = [];
    foreach ($records as $record) {
        $list[] = [
            "title" => viewRecordLink($record),
            "artist" => viewArtistLink($record->getArtists()),
            "date" => $record->getReleaseDate(),
            "genre" => viewGenreName($record->getGenres()),
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
            <th class="non-sortable">#</th>
            <th data-sort="title">Title</th>
            <th data-sort="artist">Artist</th>
            <th data-sort="date">Release Date</th>
            <th data-sort="genre">Genre</th>
            <th data-sort="price">Price</th>
        </tr>
_END;

    $i = 1;
    foreach ($recordList as $record) {
        echo <<<_END
        <tr>
            <td>$i</td>
            <td>{$record["title"]}</td>
            <td>{$record["artist"]}</td>
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
