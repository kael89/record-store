<?php
/*** Program ***/
requirePhp("view", "record");

/*** View ***/
?>
<div class="row">
    <div class="col-xs-12">
        <?php printRecordList(); ?>
    </div>
</div>

<?php
/*** Functions ***/
function printRecordList() {
    $records = getRecordsAll();

    echo <<<_END
<table class="table">
    <tbody>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Release Date</th>
            <th>Genre</th>
            <th>Price</th>
        </tr>    
_END;

    $i = 1;
    foreach ($records as $record) {
        $artist = viewRecord_ArtistLink($record);
        $title = viewRecord_RecordLink($record);
        $genre = viewRecord_Genre($record);

        echo <<<_END
        <tr>
            <td>$i</td>
            <td>$title</td>
            <td>$artist</td>
            <td>{$record->getReleaseDate()}</td>
            <td>$genre</td>
            <td>{$record->getPrice()}</td>
        </tr>
_END;
        $i++;  
    }

    echo <<<_END
    </tbody>
</table>
_END;
}
